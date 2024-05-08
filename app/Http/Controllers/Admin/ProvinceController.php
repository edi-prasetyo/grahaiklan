<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::orderBy('id', 'DESC')->paginate(10);
        return view('admin.province.index', compact('provinces'));
    }
    public function create()
    {
        return view('admin.province.create');
    }
    public function store(Request $request)
    {
        $slugRequest = Str::slug($request['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $uuid = Str::uuid()->toString();
        $province = new Province();

        if (Province::where('slug', $slugRequest)->exists()) {
            $province->slug = $slug;
        } else {
            $province->slug = $slugRequest;
        }
        $province->uuid = $uuid;
        $province->name = $request['name'];
        $province->status = $request->status == true ? '1' : '0';
        $province->save();
        return redirect('admin/provinces')->with('message', 'Bank Has Added');
    }
    public function destroy(Province $province)
    {
        $province->delete();
        return redirect()->back()->with('message', 'Brand car delete Succesfully!');
    }

    // CITY FUNCTION
    public function city(Province $province)
    {
        $cities = City::where(['province_id' => $province->id, 'status' => 1])->orderBy('id', 'asc')->paginate(10);
        return view('admin.province.city', compact('province', 'cities'));
    }
    public function store_city(Request $request)
    {
        $slugRequest = Str::slug($request['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $uuid = Str::uuid()->toString();

        $city = new City();
        $city->uuid = $uuid;
        if (City::where('slug', $slugRequest)->exists()) {
            $city->slug = $slug;
        } else {
            $city->slug = $slugRequest;
        }
        $city->name = $request['name'];
        $city->province_id = $request['province_id'];
        $city->status = $request->status == true ? '1' : '0';
        $city->save();
        return redirect()->back()->with('message', 'City Added Succesfully!');
    }
    public function destroy_city(City $city)
    {
        $city->delete();
        return redirect()->back()->with('message', 'City has been delete Succesfully!');
    }
}
