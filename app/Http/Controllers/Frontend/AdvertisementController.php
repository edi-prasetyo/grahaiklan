<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertisementFormRequest;
use App\Models\AdditionalField;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Image;
use App\Models\Province;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AdvertisementController extends Controller
{
    public function index()
    {
        $ads = Advertisement::select('advertisements.id', 'advertisements.image_url', 'advertisements.title', 'advertisements.price', 'advertisements.slug', 'advertisements.name', 'advertisements.address', 'advertisements.views', 'advertisements.phone', 'advertisements.description', 'advertisements.status', 'advertisements.updated_at', 'categories.name as category_name', 'categories.slug as category_slug', 'provinces.name as province_name', 'cities.name as city_name')
            ->leftJoin('categories', 'categories.id', '=', 'advertisements.category_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'advertisements.province_id')
            ->leftJoin('cities', 'cities.id', '=', 'advertisements.city_id')
            ->where('advertisements.status', 1)
            // ->with('additional_fields')
            ->paginate(100);


        // $additional_fields = AdditionalField::all();
        return view('frontend.advertisement.index', compact('ads'));
    }
    public function create()
    {
        if (Auth::user()) {
            return redirect('home');
        }
        $categories = Category::all();
        $provinces = Province::all();
        return view('frontend.advertisement.create', compact('categories', 'provinces'));
    }
    public function store(AdvertisementFormRequest $request)
    {
        $validatedData = $request->validated();
        $uuid  = Str::uuid()->toString();

        $slugRequest = Str::slug($validatedData['title']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $advertisement = new Advertisement();

        $advertisement->uuid = $uuid;
        $advertisement->category_id = $validatedData['category_id'];
        $advertisement->subcategory_id = $validatedData['subcategory_id'];

        if (Advertisement::where('slug', $slugRequest)->exists()) {
            $advertisement->slug = $slug;
        } else {
            $advertisement->slug = $slugRequest;
        }

        $advertisement->title = $validatedData['title'];
        $advertisement->description = $validatedData['description'];
        $advertisement->name = $validatedData['name'];
        $advertisement->email = $validatedData['email'];
        $advertisement->phone = $validatedData['phone'];
        $advertisement->website = $validatedData['website'];
        $advertisement->url = $validatedData['url'];

        $advertisement->province_id = $validatedData['province_id'];
        $advertisement->city_id = $validatedData['city_id'];
        $advertisement->address = $validatedData['address'];

        $advertisement->meta_title = $validatedData['meta_title'];
        $advertisement->meta_description = $validatedData['meta_description'];
        $advertisement->meta_keywords = $validatedData['meta_keywords'];
        $advertisement->status = 1;
        $advertisement->views = 0;
        $advertisement->save();

        return redirect('item/' . $advertisement->slug)->with('message', 'Iklan anda sudah Tayang');
    }
    public function edit()
    {
    }
    public function category($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        $ads = Advertisement::where('category_id', $category->id)->paginate(10);
        // return $ads;
        return view('frontend.advertisement.category', compact('ads'));
    }

    public function show(String $ads_slug)
    {
        $ads = Advertisement::select('advertisements.id', 'advertisements.user_id', 'advertisements.uuid', 'advertisements.title', 'advertisements.image_url', 'advertisements.name', 'advertisements.price', 'advertisements.address', 'advertisements.views', 'advertisements.phone', 'advertisements.description', 'advertisements.status', 'advertisements.updated_at', 'categories.name as category_name', 'provinces.name as province_name', 'cities.name as city_name', 'users.created_at as userjoin')
            ->join('categories', 'categories.id', '=', 'advertisements.category_id')
            ->join('provinces', 'provinces.id', '=', 'advertisements.province_id')
            ->join('cities', 'cities.id', '=', 'advertisements.city_id')
            ->join('users', 'users.id', '=', 'advertisements.user_id')
            ->where(['advertisements.slug' => $ads_slug])
            ->first();

        $user_detail = UserDetail::where('user_id', $ads->user_id)->first();
        $additional_field = AdditionalField::where('advertisement_id', $ads->id)->get();
        $images = Image::where('content_uuid', $ads->uuid)->get();
        // return $user_detail;


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
                    'images' => $images,

                ])
                ->withCookie($cookie); //store the cookie
        } else {
            return view('frontend.advertisement.show', compact('ads', 'user_detail', 'additional_field', 'images'));
        }


        // return view('frontend.advertisement.show', compact('ads'));
    }
}
