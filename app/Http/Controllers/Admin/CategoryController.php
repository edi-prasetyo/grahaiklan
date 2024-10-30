<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Field;
use App\Models\Icon;
use App\Models\Subcategory;
use Illuminate\Support\Facades\URL;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{

    public function index()
    {
        $categories =  Category::all();
        // return $categories;
        return view('admin.category.index', compact('categories'));
    }

    // public function fetchBrand(Request $request)
    // {
    //     $data['brands'] = Brand::where("category_id", $request->category_id)
    //         ->get(["name", "id"]);

    //     return response()->json($data);
    // }

    public function create()
    {
        return view('admin.category.create');
    }
    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        $uuid =  $uuid = Str::uuid()->toString();
        $slugRequest = Str::slug($validatedData['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $category = new Category;

        $category->uuid = $uuid;
        $category->name = $validatedData['name'];
        $category->icon = $validatedData['icon'];
        if (Category::where('slug', $slugRequest)->exists()) {
            $category->slug = $slug;
        } else {
            $category->slug = $slugRequest;
        }
        $category->description = $validatedData['description'];



        // if ($request->hasFile('image')) {
        //     $manager = new ImageManager(new Driver());
        //     $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
        //     $img = $manager->read($request->file('image'));

        //     $img = $img->scale(50);
        //     $img->toPng()->save(base_path('public/uploads/category/' . $name_gen));
        //     $save_url = $name_gen;

        //     $category->image = $save_url;
        //     $category->image_url = URL::to('/uploads/category/' . $name_gen);
        // }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/category/', $filename);
            $category->image = $filename;
            $category->image_url = URL::to('/uploads/category/' . $filename);
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_description = $validatedData['meta_description'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->premium = $request->premium == true ? '1' : '0';
        $category->status = $request->status == true ? '1' : '0';

        $category->save();
        return redirect('admin/category')->with('message', 'Category Has Added');
    }
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }
    public function update(CategoryFormRequest $request, $category)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($category);

        $category->name = $validatedData['name'];
        $category->icon = $validatedData['icon'];
        $category->description = $validatedData['description'];



        if ($request->hasFile('image')) {

            $path = 'uploads/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/category/', $filename);
            $category->image = $filename;
            $category->image_url = URL::to('/uploads/category/' . $filename);
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_description = $validatedData['meta_description'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->premium = $request->premium == true ? '1' : '0';
        $category->status = $request->status == true ? '1' : '0';
        $category->premium = $request->premium == true ? '1' : '0';

        $category->update();
        return redirect('admin/category')->with('message', 'Category update Succesfully');
    }

    public function destroy(Category $category)
    {
        if ($category->count() > 0) {

            $destination = $category->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $category->delete();
            return redirect()->back()->with('message', 'Image Category Delete Succesfully!');
        }
        return redirect()->back()->with('message', 'Someting Went Wrong');
    }

    // SUBCATEGORIES FUNCTION
    public function subcategory(Category $category)
    {

        $subcategory = Subcategory::where(['category_id' => $category->id, 'status' => 1])->orderBy('id', 'asc')->paginate(10);
        return view('admin.category.subcategory', compact('subcategory', 'category'));
    }
    public function store_subcategory(Request $request)
    {
        $uuid =  $uuid = Str::uuid()->toString();
        $slugRequest = Str::slug($request['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $subcategory = new Subcategory();
        $subcategory->uuid = $uuid;
        $subcategory->category_id = $request['category_id'];
        $subcategory->name = $request['name'];
        if (Subcategory::where('slug', $slugRequest)->exists()) {
            $subcategory->slug = $slug;
        } else {
            $subcategory->slug = $slugRequest;
        }
        $subcategory->status = $request->status == true ? '1' : '0';
        $subcategory->premium = $request->status == true ? '1' : '0';
        $subcategory->save();

        return redirect()->back()->with('message', 'Subcategory has ben Added');
    }
    public function edit_subcategory(Subcategory $subcategory)
    {
        return view('admin.category.edit_subcategory', compact('subcategory'));
    }
    public function update_subcategory(Request $request, int $subcategory_id)
    {
        $subcategory = Subcategory::where('id', $subcategory_id)->first();
        $category = Category::where('id', $subcategory->category_id)->first();

        $subcategory->name = $request['name'];
        $subcategory->premium = $request->premium == true ? '1' : '0';
        $subcategory->status = $request->status == true ? '1' : '0';
        $subcategory->premium = $request->premium == true ? '1' : '0';
        $subcategory->update();

        return redirect('admin/category/subcategory/' . $category->id)->with('message', 'Brand update Succesfully');
    }
    public function destroy_subcategory(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->back()->with('message', 'Subcategory delete Succesfully!');
    }

    // Field funnction
    public function field(Subcategory $subcategory)
    {
        $icons = Icon::all();
        $fields = Field::where('subcategory_id', $subcategory->id)->get();
        // return $subcategory;
        return view('admin.category.field', compact('fields', 'subcategory', 'icons'));
    }
    public function store_field(Request $request)
    {

        $uuid = Str::uuid()->toString();
        $field = new Field();
        $field->uuid = $uuid;
        $field->category_id = $request['category_id'];
        $field->subcategory_id = $request['subcategory_id'];
        $field->field_name = $request['field_name'];
        $field->field_value = $request['field_value'];
        $field->field_icon = $request['field_icon'];

        $field->save();
        return redirect()->back()->with('message', 'Field Added Succesfully');
    }
}
