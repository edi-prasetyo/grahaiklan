<?php


namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementFormRequest;
use App\Models\AdditionalField;
use App\Models\Advertisement;
use App\Models\Bank;
use App\Models\Category;
use App\Models\City;
use App\Models\Field;
use App\Models\Image;
use App\Models\Option;
use App\Models\Order;
use App\Models\Package;
use App\Models\Province;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {

        $provinces = Province::all();
        $user = User::where('email', auth()->user()->email)->first();
        $user_detail = UserDetail::where('user_id', $user->id)->first();
        $ads = Advertisement::where(['user_id' => $user->id, 'status' => 1])->paginate(10);
        $categories = Category::where('premium', 1)->get();
        $premium_ads = $user_detail->premium_ads;
        return view('home/home', compact('user', 'user_detail', 'provinces', 'ads', 'premium_ads', 'categories'));
    }


    public function profile()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $user_detail = UserDetail::where('user_id', $user_id)->first();
        $provinces = Province::all();

        return view('home.profile', compact('user', 'user_detail', 'provinces'));
    }

    public function packages()
    {
        $date_now = date('Y-m-d H:i:s');
        $user_id = Auth::user()->id;
        $user_detail = UserDetail::where('user_id', $user_id)->first();

        $packages = Package::all();

        $order = Order::where([['user_id', '=', $user_id], ['cancel', '=', 0], ['status', '=', 0]])
            ->latest()
            ->first();

        return view('home.package', compact('packages', 'order', 'user_detail'));
    }
    public function order_package(Request $request)
    {
        $user_id = Auth::user()->id;
        $uuid =  $uuid = Str::uuid()->toString();
        $invoice_no = rand(10000, 99999);
        $order_code =  Str::random(5);

        $order = new Order();
        $order->user_id = $user_id;
        $order->order_code = $order_code;
        $order->invoice_no = $invoice_no;
        $order->package_id = $request['package_id'];
        $order->package_name = $request['package_name'];
        $order->amount = $request['amount'];
        $order->count = $request['count'];
        $order->ads_period = $request['ads_period'];
        $order->active_period = $request['active_period'];
        $order->uuid = $uuid;
        $order->status = 0;

        $order->save();
        Alert::success('Order', 'Order Berhasil, silahkan lanjut Pembayaran');
        return redirect('payment/' . $order->uuid);
    }
    public function payment($uuid)
    {
        $user_id = Auth::user()->id;
        $order = Order::where([['uuid', '=', $uuid], ['user_id', '=', $user_id],])->first();
        $banks = Bank::all();
        // return $order;
        return view('home.payment', compact('order', 'banks'));
    }
    public function receipt(Request $request, $uuid)
    {

        $user_id = Auth::user()->id;
        $order = Order::where([['uuid', '=', $uuid], ['user_id', '=', $user_id],])->first();

        $order->payment_status = 2;
        if ($request->hasFile('receipt')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('receipt')->getClientOriginalExtension();
            $img = $manager->read($request->file('receipt'));

            $img = $img->scale(500);
            $img->toPng()->save(base_path('public/uploads/receipt/' . $name_gen));
            // $save_url = $name_gen;
            $order->receipt = URL::to('/uploads/receipt/' . $name_gen);
        }
        $order->update();
        Alert::success('Pembayaran', 'Pembayaran Telah terkirim');
        return redirect()->back();
    }

    public function update_profile(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_detail = UserDetail::where('user_id', $user_id)->first();

        if ($request->hasFile('photo')) {

            $path = 'uploads/logo/' . $user_detail->photo;
            if (File::exists($path)) {
                unlink($path);
            }

            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('photo')->getClientOriginalExtension();
            $img = $manager->read($request->file('photo'));

            $img = $img->scale(50);
            $img->toPng()->save(base_path('public/uploads/logo/' . $name_gen));
            $save_url = $name_gen;

            $user_detail->photo = $save_url;
            $user_detail->photo_url = URL::to('/uploads/logo/' . $name_gen);
        }

        if ($request->hasFile('logo')) {

            $path = 'uploads/logo/' . $user_detail->logo;
            if (File::exists($path)) {
                unlink($path);
            }

            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('logo')->getClientOriginalExtension();
            $img = $manager->read($request->file('logo'));

            $img = $img->scale(200);
            $img->toPng()->save(base_path('public/uploads/logo/' . $name_gen));
            $save_url = $name_gen;

            $user_detail->logo = $save_url;
            $user_detail->logo_url = URL::to('/uploads/logo/' . $name_gen);
        }

        $user_detail->fullname = $request['fullname'];
        $user_detail->province_id = $request['province_id'];
        $user_detail->city_id = $request['city_id'];
        $user_detail->address = $request['address'];
        $user_detail->about = $request['about'];
        $user_detail->update();
        Alert::success('Update Profile', 'Update Profile Berhasil');
        return redirect()->back();
    }

    // public function create()
    // {
    //     $user_id = Auth::user()->id;
    //     $user = User::where('id', $user_id)->first();
    //     $user_detail = UserDetail::where('user_id', $user_id);

    //     $categories = Category::all();
    //     $provinces = Province::all();

    //     return view('home/create', compact('categories', 'provinces', 'user', 'user_detail'));
    // }
    // public function store(Request $request)
    // {
    //     $option = Option::first();
    //     $watermark_logo = $option->watermark;

    //     $validated = $request->validate([
    //         'title' => 'required',
    //     ]);

    //     $user_id = Auth::user()->id;

    //     $numberOfPosts = Advertisement::whereDate('created_at', Carbon::today())->where('user_id', $user_id)->count();
    //     if ($numberOfPosts < $option->ads_limit) {

    //         $uuid =  $uuid = Str::uuid()->toString();
    //         $slugRequest = Str::slug($validated['title']);
    //         $code = random_int(00, 99);
    //         $slug = $slugRequest . '-' . $code;



    //         $ad = new Advertisement();

    //         $ad->uuid = $uuid;
    //         $ad->title = $validated['title'];
    //         if (Advertisement::where('slug', $slugRequest)->exists()) {
    //             $ad->slug = $slug;
    //         } else {
    //             $ad->slug = $slugRequest;
    //         }
    //         $ad->description = $request['description'];
    //         $ad->category_id = $request['category_id'];
    //         $ad->subcategory_id = $request['subcategory_id'];
    //         $ad->user_id = $user_id;
    //         $ad->name = $request['name'];
    //         $ad->email = $request['email'];
    //         $ad->phone = $request['phone'];
    //         $ad->phone = $request['phone'];
    //         $ad->url = $request['url'];
    //         $ad->province_id = $request['province_id'];
    //         $ad->city_id = $request['city_id'];
    //         $ad->status = 1;

    //         $ad->meta_title = $request['meta_title'];
    //         $ad->meta_description = $request['meta_description'];
    //         $ad->meta_keywords = $request['meta_keywords'];

    //         $ad->save();
    //         Alert::success('Success Title', 'Success Message');
    //         return redirect('home');
    //     }
    // }

    public function edit_password()
    {
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);
        return view('frontend.member.edit_password', compact('user'));
    }
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("province_id", $request->province_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    // ADS FUNCTION
    public function add_iklan()
    {
        $categories = Category::all();

        return view('home.add_iklan', compact('categories'));
    }

    public function add_iklan_sub($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $subcategories = Subcategory::where('category_id', $category->id)->get();
        return view('home.add_iklan_sub', compact('subcategories', 'category'));
    }
    // public function create_iklan($category_slug, $slug)
    // {
    //     $date_now = date('Y-m-d H:i:s');
    //     $user_id = Auth::user()->id;
    //     $order = Order::where([['user_id', '=', $user_id], ['payment_status', '=', 1], ['expired_at', '>=', $date_now], ['count', '>', 0]])->first();


    //     $subcategory = Subcategory::where('slug', $slug)->first();
    //     if ($subcategory->premium == 0) {
    //         $user = User::where('id', $user_id)->first();
    //         $user_detail = UserDetail::where('user_id', $user_id);
    //         $provinces = Province::all();

    //         $category = Category::where('slug', $category_slug)->first();
    //         $subcategory = Subcategory::where('slug', $slug)->first();
    //         $fields = Field::where('subcategory_id', $subcategory->id)->get();

    //         return view('home.create_iklan', compact('category', 'subcategory', 'user', 'user_detail', 'provinces', 'fields'));
    //     } else {
    //         // return "Iklan Premium";
    //         if (empty($order)) {
    //             // return "Tidak Ada Paket Iklan";
    //             return redirect('packages');
    //         } else {

    //             return "Ada Paket Iklan";
    //         }
    //     }
    // }
    public function create_iklan($category_slug, $slug)
    {

        $user_id = Auth::user()->id;
        $user_detail = UserDetail::where('user_id', $user_id)->first();

        $subcategory = Subcategory::where('slug', $slug)->first();
        if ($subcategory->premium == 0) {
            $user = User::where('id', $user_id)->first();
            $user_detail = UserDetail::where('user_id', $user_id);
            $provinces = Province::all();

            $category = Category::where('slug', $category_slug)->first();
            $subcategory = Subcategory::where('slug', $slug)->first();
            $fields = Field::where('subcategory_id', $subcategory->id)->get();

            return view('home.create_iklan', compact('category', 'subcategory', 'user', 'user_detail', 'provinces', 'fields'));
        } else {
            // return "Iklan Premium";
            if ($user_detail->premium_ads == 0) {
                // return "Tidak Ada Paket Iklan";
                Alert::error('Paket Iklan', 'Anda tidak memiliki paket iklan premium');
                return redirect('packages');
            } else {
                // return "Ada Paket Iklan";
                $user = User::where('id', $user_id)->first();
                $user_detail = UserDetail::where('user_id', $user_id);
                $provinces = Province::all();

                $category = Category::where('slug', $category_slug)->first();
                $subcategory = Subcategory::where('slug', $slug)->first();
                $fields = Field::where('subcategory_id', $subcategory->id)->get();

                return view('home.create_iklan', compact('category', 'subcategory', 'user', 'user_detail', 'provinces', 'fields'));
            }
        }
    }
    public function edit_iklan($category_slug, $slug, $advertisement_id)
    {

        $user_id = Auth::user()->id;
        $user_detail = UserDetail::where('id', $user_id)->first();

        $subcategory = Subcategory::where('slug', $slug)->first();
        if ($subcategory->premium == 0) {
            $user = User::where('id', $user_id)->first();
            $user_detail = UserDetail::where('user_id', $user_id);
            $provinces = Province::all();

            $category = Category::where('slug', $category_slug)->first();
            $subcategory = Subcategory::where('slug', $slug)->first();
            $fields = Field::where('subcategory_id', $subcategory->id)->get();

            return view('home.create_iklan', compact('category', 'subcategory', 'user', 'user_detail', 'provinces', 'fields'));
        } else {
            // return "Iklan Premium";
            if ($user_detail->premium_ads == 0) {
                // return "Tidak Ada Paket Iklan";
                Alert::error('Paket Iklan', 'Anda tidak memiliki paket iklan premium');
                return redirect('packages');
            } else {
                // return "Ada Paket Iklan";
                $user = User::where('id', $user_id)->first();
                $user_detail = UserDetail::where('user_id', $user_id);
                $provinces = Province::all();

                $category = Category::where('slug', $category_slug)->first();
                $subcategory = Subcategory::where('slug', $slug)->first();
                $fields = Field::where('subcategory_id', $subcategory->id)->get();

                return view('home.edit_iklan', compact('category', 'subcategory', 'user', 'user_detail', 'provinces', 'fields'));
            }
        }
    }
    public function store_iklan(Request $request)
    {
        $option = Option::first();
        $watermark_logo = $option->watermark;

        $validated = $request->validate([
            'title' => 'required',
        ]);

        $uuid =  $uuid = Str::uuid()->toString();
        $slugRequest = Str::slug($validated['title']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();

        $ad = new Advertisement();

        $ad->uuid = $uuid;
        $ad->title = $validated['title'];
        if (Advertisement::where('slug', $slugRequest)->exists()) {
            $ad->slug = $slug;
        } else {
            $ad->slug = $slugRequest;
        }
        $ad->description = $request['description'];

        $ad->category_id = $request['category_id'];
        $ad->subcategory_id = $request['subcategory_id'];
        $ad->user_id = $user_id;
        $ad->name = $request['name'];
        $ad->price = Str::replace(['Rp. ', '.'], "", $request['price']);
        $ad->email = $user->email;
        $ad->phone = $user->phone;

        $ad->province_id = $request['province_id'];
        $ad->city_id = $request['city_id'];
        if ($option->ads_status == 1) {
            $ad->status = 1;
        } else {
            $ad->status = 0;
        }
        $ad->meta_title = $request['meta_title'];
        $ad->meta_description = $request['meta_description'];
        $ad->meta_keywords = $request['meta_keywords'];

        $ad->save();

        $user_detail = UserDetail::where('user_id', $user_id)->first();
        $count_ads = $user_detail->premium_ads - 1;
        $user_detail->premium_ads = $count_ads;
        $user_detail->update();

        if (is_array($request->field_name) || is_object($request->field_name)) {
            foreach ($request->field_name as $key => $field_name) {
                $fields[] = [
                    'uuid' => $uuid,
                    'advertisement_id' => $ad->id,
                    'field_name' => $field_name,
                    'field_icon' => $request->field_icon[$key],
                    'field_value' => $request->field_value[$key]
                ];
            }
            AdditionalField::insert($fields);
        }

        if ($request->hasFile('image')) {
            $i = 1;
            foreach ($request->file('image') as $imageFile) {
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . $i++ . '.' . $imageFile->getClientOriginalExtension();

                $imageFile = $manager->read($imageFile);
                $imageFile = $imageFile->scale(height: 500);
                if ($watermark_logo == null) {
                } else {
                    $imageFile->place('uploads/logo/' . $watermark_logo, 'center');
                    // $imageThumb->place('uploads/logo/' . $watermark_logo, 'center');
                }
                $imageFile->toJpeg(80)->save(base_path('public/uploads/images/' . $name_gen));

                $imageThumb = $manager->read($imageFile);
                $imageThumb = $imageFile->cover(200, 200);
                $imageThumb->toJpeg(80)->save(base_path('public/uploads/images/thumbs/' . $name_gen));

                $adsimages = new Image();
                $adsimages->advertisement_id = $ad->id;
                $adsimages->name = $ad->title;
                $adsimages->from = 'ads';
                $adsimages->image = $name_gen;
                $adsimages->image_url = URL::to('/uploads/images/thumbs/' . $name_gen);

                $adsimages->save();
            }
        }
        Alert::success('Success', 'Iklan Sudah di Posting');
        return redirect('my-ads');
    }


    public function myads()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $user_detail = UserDetail::where('user_id', $user_id)->first();
        $ads = Advertisement::orderBy('id', 'desc')
            ->join('categories', 'categories.id', '=', 'advertisements.category_id')
            ->join('subcategories', 'subcategories.id', '=', 'advertisements.subcategory_id')
            ->select('advertisements.*', 'categories.slug as category_slug', 'subcategories.slug as subcategory_slug')
            ->where(['user_id' => $user->id])
            ->paginate(10);
        $categories = Category::where('premium', 1)->get();
        return view('home.iklan', compact('user', 'user_detail', 'ads', 'categories'));
    }
    public function edit_myads($advertisement_id)
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $user_detail = UserDetail::where('user_id', $user_id)->first();

        $advertisement = Advertisement::where(['user_id' => $user->id, 'id' => $advertisement_id])->first();
        $categories = Category::where('premium', 1)->get();
        if ($advertisement->user_id == $user_id) {
            return view('home.edit_iklan', compact('user', 'user_detail', 'advertisement', 'categories'));
        } else {
            Alert::error('Error', 'Anda tidak dapat mengakses Iklan ini');
            return redirect('myads');
        }
    }

    // Select Category

    public function category()
    {
        $categories = Category::all();
        return view('home.category', compact('categories'));
    }
    public function destroy_account() {}
}
