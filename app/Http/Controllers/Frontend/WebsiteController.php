<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Product;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
    }
    public function subscription($uuid)
    {
        $productDetail = Product::where('uuid', $uuid)->first();
        $option = Option::where('id', 1)->first();
        $product_id = $productDetail->id;

        $websites = Website::where('product_id', $product_id)->get();
        // return $websites;
        return view('frontend.website.subscription', compact('productDetail', 'option', 'websites'));
    }
    public function order($uuid)
    {
        $website = Website::where('uuid', $uuid)->first();
        $product = Product::where('id', $website->product_id)->first();
        // return $product;
        return view('frontend.website.order', compact('website', 'product'));
    }
}
