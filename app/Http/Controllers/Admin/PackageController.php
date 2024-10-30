<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('id', 'asc')->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }
    public function create()
    {
        return view('admin.packages.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description_period' => 'required',
            'description_ads' => 'required',
            'count' => 'required',
            'price' => 'required',
            'active_period' => 'required',
            'ads_period' => 'required',
        ]);
        $uuid = Str::uuid()->toString();

        $package = new Package();
        $package->uuid = $uuid;
        $package->name = $validated['name'];
        $package->description_period = $validated['description_period'];
        $package->description_ads = $validated['description_ads'];
        $package->count = $validated['count'];
        $package->price = $validated['price'];
        $package->active_period = $validated['active_period'];
        $package->ads_period = $validated['ads_period'];

        $package->save();
        return redirect('admin/packages')->with('message', 'Paket Berhasil Di tambahkan');
    }
    public function show($id)
    {
        $package = Package::where('id', $id)->first();
        return view('admin.packages.show', compact('package'));
    }
    public function edit($id)
    {
        $package = Package::where('id', $id)->first();
        return view('admin.packages.edit', compact('package'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description_period' => 'required',
            'description_ads' => 'required',
            'count' => 'required',
            'price' => 'required',
            'active_period' => 'required',
            'ads_period' => 'required',
        ]);
        $uuid = Str::uuid()->toString();

        $package = Package::where('id', $id)->first();
        $package->uuid = $uuid;
        $package->name = $validated['name'];
        $package->description_period = $validated['description_period'];
        $package->description_ads = $validated['description_ads'];
        $package->count = $validated['count'];
        $package->price = $validated['price'];
        $package->active_period = $validated['active_period'];
        $package->ads_period = $validated['ads_period'];

        $package->update();
        return redirect('admin/packages')->with('message', 'Paket Berhasil Di Update');
    }
}
