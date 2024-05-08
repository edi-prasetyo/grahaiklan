<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        if ($categories) {
            return response()->json([
                'success' => true,
                'data' => $categories
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }
    public function store(Request $request)
    {
        $uuid = Str::uuid()->toString();
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'status'   => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        $slugRequest = Str::slug($request['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $category = new Category();
        if (Category::where('slug', $slugRequest)->exists()) {
            $category->slug = $slug;
        } else {
            $category->slug = $slugRequest;
        }
        $category->uuid = $uuid;
        $category->name = $request['name'];
        $category->description = $request['description'];
        $category->status = $request['status'];
        $category->meta_title = $request['meta_title'];
        $category->meta_description = $request['meta_description'];
        $category->meta_keyword = $request['meta_keyword'];

        $category->save();

        return response()->json([
            'success' => true,
            'data' => $category,
        ]);
    }
}
