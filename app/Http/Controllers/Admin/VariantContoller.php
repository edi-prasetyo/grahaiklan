<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class VariantContoller extends Controller
{
    public function index()
    {
        $variants = Variant::orderBy('id', 'DESC')->paginate(10);
        return view('admin.variant.index', compact('variants'));
    }
    public function create()
    {
        return view('admin.variant.create');
    }
    public function store(Request $request)
    {
        $uuid =  $uuid = Str::uuid()->toString();
        $slugRequest = Str::slug($request['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $variant = new Variant();
        $variant->name = $request['name'];
        $variant->uuid = $uuid;

        if (Variant::where('slug', $slugRequest)->exists()) {
            $variant->slug = $slug;
        } else {
            $variant->slug = $slugRequest;
        }
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = 'varian' . time() . '.' . $ext;
            $file->move('uploads/logo/', $filename);
            $variant->image = $filename;
            $variant->image_url = URL::to('/uploads/logo/' . $filename);
        }

        $variant->save();
        return redirect()->back()->with('message', 'Variant Added Succesfully!');
    }
    public function edit(Variant $variant)
    {
        return view('admin.variant.edit', compact('variant'));
    }
    public function update(Request $request, Variant $variant)
    {
        $variant->name = $request['name'];

        if ($request->hasFile('image')) {

            $path = 'uploads/logo/' . $variant->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = 'variant' . time() . '.' . $ext;
            $file->move('uploads/logo/', $filename);
            $variant->image = $filename;
            $variant->image_url = URL::to('/uploads/logo/' . $filename);
        }

        $variant->update();
        return redirect('admin/variants')->with('message', 'bank update Succesfully');
    }
    public function destroy(Variant $variant)
    {
        $destination = 'uploads/logo/' . $variant->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $variant->delete();
        return redirect()->back()->with('message', 'Brand car delete Succesfully!');
    }
}
