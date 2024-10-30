<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertisementFormRequest;
use App\Models\AdditionalField;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Image;
use App\Models\Option;
use App\Models\Province;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdvertisementController extends Controller
{
    public function index()
    {

        $ads = Advertisement::select('advertisements.id',  'advertisements.title', 'advertisements.price', 'advertisements.slug', 'advertisements.name',  'advertisements.views', 'advertisements.phone', 'advertisements.description', 'advertisements.status', 'advertisements.updated_at', 'categories.name as category_name', 'categories.slug as category_slug', 'provinces.name as province_name', 'cities.name as city_name')
            ->leftJoin('categories', 'categories.id', '=', 'advertisements.category_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'advertisements.province_id')
            ->leftJoin('cities', 'cities.id', '=', 'advertisements.city_id')
            ->where('advertisements.status', 1)
            ->orderBy('id', 'desc')
            // ->with('additional_fields')
            ->paginate(6);

        $recent_ads = Advertisement::orderBy('created_at', 'asc')->where('status', 1)->take(4);
        $popular_ads = Advertisement::orderBy('views', 'asc')->where('status', 1)->take(4);


        // $additional_fields = AdditionalField::all();
        return view('frontend.advertisement.index', compact('ads', 'recent_ads', 'popular_ads'));
    }
    public function category()
    {
        if (Auth::user()) {
            return redirect('home');
        }
        $categories = Category::orderBy('id', 'asc')->where('premium', 0);
        $provinces = Province::all();
        return view('frontend.advertisement.create', compact('categories', 'provinces'));
    }

    public function category_detail($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        $ads = Advertisement::select('advertisements.id',  'advertisements.title', 'advertisements.price', 'advertisements.slug', 'advertisements.name',  'advertisements.views', 'advertisements.phone', 'advertisements.description', 'advertisements.status', 'advertisements.updated_at', 'categories.name as category_name', 'categories.slug as category_slug', 'provinces.name as province_name', 'cities.name as city_name')
            ->leftJoin('categories', 'categories.id', '=', 'advertisements.category_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'advertisements.province_id')
            ->leftJoin('cities', 'cities.id', '=', 'advertisements.city_id')
            ->where('advertisements.status', 1)
            ->where('category_id', $category->id)
            ->orderBy('id', 'desc')

            ->paginate(6);

        // return $ads;

        return view('frontend.advertisement.category_detail', compact('ads'));
    }
    public function subcategory($category_slug, $slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        $subcategory = Subcategory::where('slug', $slug)->first();
        $ads = Advertisement::select('advertisements.id',  'advertisements.title', 'advertisements.price', 'advertisements.slug', 'advertisements.name',  'advertisements.views', 'advertisements.phone', 'advertisements.description', 'advertisements.status', 'advertisements.updated_at', 'categories.name as category_name', 'categories.slug as category_slug', 'provinces.name as province_name', 'cities.name as city_name')
            ->leftJoin('categories', 'categories.id', '=', 'advertisements.category_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'advertisements.province_id')
            ->leftJoin('cities', 'cities.id', '=', 'advertisements.city_id')
            ->where('advertisements.status', 1)
            ->orderBy('id', 'desc')
            ->where('subcategory_id', $subcategory->id)
            ->paginate(10);
        // return $ads;
        return view('frontend.advertisement.subcategory', compact('ads', 'category', 'subcategory'));
    }

    public function show(String $ads_slug)
    {
        $ads = Advertisement::select('advertisements.id', 'advertisements.user_id', 'advertisements.uuid', 'advertisements.title', 'advertisements.name', 'advertisements.price', 'advertisements.views', 'advertisements.phone', 'advertisements.description', 'advertisements.status', 'advertisements.updated_at', 'categories.name as category_name', 'categories.id as category_id',  'provinces.name as province_name', 'cities.name as city_name', 'users.created_at as userjoin')
            ->join('categories', 'categories.id', '=', 'advertisements.category_id')
            ->join('provinces', 'provinces.id', '=', 'advertisements.province_id')
            ->join('cities', 'cities.id', '=', 'advertisements.city_id')
            ->join('users', 'users.id', '=', 'advertisements.user_id')
            ->where(['advertisements.slug' => $ads_slug])
            ->with('images')
            ->first();
        // return $ads;

        $recent_ads = Advertisement::orderBy('created_at', 'asc')->where('status', 1)->limit(4)->get();
        $popular_ads = Advertisement::orderBy('views', 'asc')->where('status', 1)->limit(4)->get();
        $related_ads = Advertisement::select('advertisements.id', 'advertisements.user_id', 'advertisements.uuid', 'advertisements.title', 'advertisements.name', 'advertisements.price', 'advertisements.views', 'advertisements.phone', 'advertisements.description', 'advertisements.status', 'advertisements.updated_at', 'categories.name as category_name', 'categories.id as category_id', 'provinces.name as province_name', 'cities.name as city_name')
            ->join('categories', 'categories.id', '=', 'advertisements.category_id')
            ->join('provinces', 'provinces.id', '=', 'advertisements.province_id')
            ->join('cities', 'cities.id', '=', 'advertisements.city_id')
            ->where('advertisements.status', 1)
            ->where('advertisements.category_id', $ads->category_id)
            ->limit(4)->get();
        // return $related_ads;

        $user_detail = UserDetail::where('user_id', $ads->user_id)->first();
        $additional_field = AdditionalField::where('advertisement_id', $ads->id)->get();



        if (!Auth::check()) { //guest user identified by ip
            $cookie_name = (Str::replace('.', '', (request()->ip())) . '-' . $ads->id);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $ads->id); //logged in user
        }
        if (Cookie::get($cookie_name) == '') { //check if cookie is set
            $cookie = cookie($cookie_name, '1', 60); //set the cookie
            $ads->incrementReadCount(); //count the view


            return response()
                ->view('frontend.advertisement.show', [
                    'ads' => $ads,
                    'user_detail' => $user_detail,
                    'additional_field' => $additional_field,
                    'recent_ads' => $recent_ads,
                    'popular_ads' => $popular_ads,
                    'related_ads' => $related_ads
                    // 'images' => $images,

                ])
                ->withCookie($cookie); //store the cookie
        } else {
            return view('frontend.advertisement.show', compact('ads', 'user_detail', 'additional_field', 'recent_ads', 'popular_ads', 'related_ads'));
        }


        // return view('frontend.advertisement.show', compact('ads'));
    }

    public function user(int $id)
    {
        $user = User::where('id', $id)->first();


        $ads = Advertisement::select('advertisements.id',  'advertisements.title', 'advertisements.price', 'advertisements.slug', 'advertisements.name',  'advertisements.views', 'advertisements.phone', 'advertisements.description', 'advertisements.status', 'advertisements.updated_at', 'categories.name as category_name', 'categories.slug as category_slug', 'provinces.name as province_name', 'cities.name as city_name')
            ->leftJoin('categories', 'categories.id', '=', 'advertisements.category_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'advertisements.province_id')
            ->leftJoin('cities', 'cities.id', '=', 'advertisements.city_id')
            ->where('advertisements.status', 1)
            ->where('advertisements.user_id', $id)
            // ->with('additional_fields')
            ->paginate(4);

        $user_detail = UserDetail::where('user_id', $id)->first();
        // $additional_fields = AdditionalField::all();
        return view('frontend.advertisement.user', compact('ads', 'user', 'user_detail'));
    }

    public function search(Request $request)
    {

        $categories = Category::where('status', 1)->with('advertisements')->get();
        $provinces = Province::all();

        $category_id = $request['category_id'];
        $province_id = $request['province_id'];
        $keyword = $request['keyword'];

        Session::put('category_id', $category_id);
        Session::put('province_id', $province_id);
        Session::put('keyword', $keyword);

        $ads = Advertisement::select('advertisements.id',  'advertisements.title', 'advertisements.price', 'advertisements.slug', 'advertisements.name',  'advertisements.views', 'advertisements.phone', 'advertisements.description', 'advertisements.status', 'advertisements.updated_at', 'categories.name as category_name', 'categories.slug as category_slug', 'provinces.name as province_name', 'cities.name as city_name')
            ->where('advertisements.category_id', 'like', "%" . $category_id . "%")
            ->where('advertisements.province_id', 'like', "%" . $province_id . "%")
            ->where('advertisements.title', 'like', "%" . $keyword . "%")
            ->leftJoin('categories', 'categories.id', '=', 'advertisements.category_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'advertisements.province_id')
            ->leftJoin('cities', 'cities.id', '=', 'advertisements.city_id')
            ->paginate(1)->withQueryString();
        // ->get();

        // return $result;

        return view('frontend.advertisement.search', compact('ads', 'categories', 'provinces', 'category_id', 'province_id', 'keyword'));
    }
}
