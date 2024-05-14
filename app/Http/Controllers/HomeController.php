<?php


namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementFormRequest;
use App\Models\AdditionalField;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\City;
use App\Models\Field;
use App\Models\Image;
use App\Models\Option;
use App\Models\Province;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;
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
        $ads = Advertisement::where(['user_id' => $user->id, 'status' => 1])->paginate(10);
        $categories = Category::where('premium', 1)->get();
        return view('home/home', compact('user', 'provinces', 'ads', 'categories'));
    }
    public function create()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $user_detail = UserDetail::where('user_id', $user_id);

        $categories = Category::all();
        $provinces = Province::all();

        return view('home/create', compact('categories', 'provinces', 'user', 'user_detail'));
    }
    public function store(Request $request)
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

        $ad = new Advertisement();

        $ad->uuid = $uuid;
        $ad->title = $validated['title'];
        if (Advertisement::where('slug', $slugRequest)->exists()) {
            $ad->slug = $slug;
        } else {
            $ad->slug = $slugRequest;
        }
        $ad->description = $request['description'];
        $ad->price = $request['price'];
        $ad->category_id = $request['category_id'];
        $ad->subcategory_id = $request['subcategory_id'];
        $ad->user_id = $user_id;
        $ad->name = $request['name'];
        $ad->email = $request['email'];
        $ad->phone = $request['phone'];

        $ad->province_id = $request['province_id'];
        $ad->city_id = $request['city_id'];
        $ad->status = 1;

        $ad->meta_title = $request['meta_title'];
        $ad->meta_description = $request['meta_description'];
        $ad->meta_keywords = $request['meta_keywords'];

        $ad->save();


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
                }

                $imageFile->toJpeg(80)->save(base_path('public/uploads/images/' . $name_gen));

                $adsimages = new Image();
                $adsimages->advertisement_id = $ad->id;
                $adsimages->name = $ad->title;
                $adsimages->from = 'ads';
                $adsimages->image = $name_gen;
                $adsimages->image_url = URL::to('/uploads/images/' . $name_gen);

                $adsimages->save();
            }
        }


        Alert::success('Success Title', 'Success Message');
        return redirect('home');
    }

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
    public function add_iklan($category_slug)
    {
        $category = Category::where(['slug' => $category_slug, 'premium' => 1])->first();
        $subcategories = Subcategory::where('category_id', $category->id)->get();
        return view('home.add_iklan', compact('category', 'subcategories'));
    }
    public function add_iklan_sub($slug)
    {

        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $user_detail = UserDetail::where('user_id', $user_id);
        $provinces = Province::all();

        $subcategory = Subcategory::where('slug', $slug)->first();
        $fields = Field::where('subcategory_id', $subcategory->id)->get();
        // return $fields;
        $category = Category::where('id', $subcategory->category_id)->first();
        return view('home.add_iklan_sub', compact('category', 'subcategory', 'user', 'user_detail', 'provinces', 'fields'));
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
        $ad->price = $request['price'];
        $ad->email = $request['email'];
        $ad->phone = $request['phone'];
        $ad->url = $request['url'];
        $ad->province_id = $request['province_id'];
        $ad->city_id = $request['city_id'];
        $ad->status = 1;

        $ad->meta_title = $request['meta_title'];
        $ad->meta_description = $request['meta_description'];
        $ad->meta_keywords = $request['meta_keywords'];

        $ad->save();

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
                }

                $imageFile->toJpeg(80)->save(base_path('public/uploads/images/' . $name_gen));

                $adsimages = new Image();
                $adsimages->advertisement_id = $ad->id;
                $adsimages->name = $ad->title;
                $adsimages->from = 'ads';
                $adsimages->image = $name_gen;
                $adsimages->image_url = URL::to('/uploads/images/' . $name_gen);

                $adsimages->save();
            }
        }

        return redirect('home')->with('message', 'Iklan Sudah di tambahkan');
    }
}
