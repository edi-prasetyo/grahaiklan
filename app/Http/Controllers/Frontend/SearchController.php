<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $result = Advertisement::query();

        if (!empty($text)) {
            $result = $result->where('text', 'like', '%' . $text . '%');
        }

        if (!empty($pet)) {
            $result = $result->where('pet', $pet);
        }

        if (!empty($category)) {
            $result = $result->where('category', $category);
        }

        if (!empty($city)) {
            $result = $result->where('city', 'like', '%' . $city . '%');
        }

        $result = $result->get();
    }
}
