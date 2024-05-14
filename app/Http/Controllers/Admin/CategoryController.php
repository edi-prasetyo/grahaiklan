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
use App\Models\Subcategory;
use App\Models\Type;
use Illuminate\Support\Facades\URL;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public $category_id;
    public function index()
    {
        $categories =  Category::orderBy('id', 'DESC')->paginate(3);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fetchBrand(Request $request)
    {
        $data['brands'] = Brand::where("category_id", $request->category_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

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
        //     $file = $request->file('image');
        //     $ext = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $ext;
        //     $file->move('uploads/category/', $filename);

        //     $img = ImageResize::make($file);
        //     if (ImageResize::make($file)->width() > 720) {
        //         $img->resize(720, null, function ($constraint) {
        //             $constraint->aspectRatio();
        //         });
        //     }
        //     $img->save(public_path('uploads/category/thumbs/') . $filename);


        //     $category->image = $filename;
        //     $category->image_url = URL::to('/uploads/category/' . $filename);
        // }

        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            $img = $manager->read($request->file('image'));

            $img = $img->scale(50);
            $img->toPng()->save(base_path('public/uploads/category/' . $name_gen));
            $save_url = $name_gen;

            $category->image = $save_url;
            $category->image_url = URL::to('/uploads/category/' . $name_gen);
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

        // $uploadPath = 'uploads/category/';
        // if ($request->hasFile('image')) {

        //     $path = 'uploads/category/' . $category->image;
        //     if (File::exists($path)) {
        //         File::delete($path);
        //     }

        //     $file = $request->file('image');
        //     $ext = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $ext;
        //     $file->move('uploads/category/', $filename);
        //     $category->image = $uploadPath . $filename;
        // }

        if ($request->hasFile('image')) {

            $path = 'uploads/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            $img = $manager->read($request->file('image'));

            $img = $img->scale(50);
            $img->toPng()->save(base_path('public/uploads/category/' . $name_gen));
            $save_url = $name_gen;

            $category->image = $save_url;
            $category->image_url = URL::to('/uploads/category/' . $name_gen);
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_description = $validatedData['meta_description'];
        $category->meta_keyword = $validatedData['meta_keyword'];
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

        $subctegory = new Subcategory();
        $subctegory->uuid = $uuid;
        $subctegory->category_id = $request['category_id'];
        $subctegory->name = $request['name'];
        if (Subcategory::where('slug', $slugRequest)->exists()) {
            $subctegory->slug = $slug;
        } else {
            $subctegory->slug = $slugRequest;
        }
        $subctegory->status = $request->status == true ? '1' : '0';
        $subctegory->premium = $request->premium == true ? '1' : '0';
        $subctegory->save();

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

        $fields = Field::where('subcategory_id', $subcategory->id)->get();
        // return $subcategory;
        return view('admin.category.field', compact('fields', 'subcategory'));
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
