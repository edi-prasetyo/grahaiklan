<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisements = Advertisement::select('advertisements.title', 'advertisements.status', 'advertisements.id', 'categories.name as category_name')
            ->join('categories', 'categories.id', '=', 'advertisements.category_id')
            ->orderBy('advertisements.id', 'desc')->paginate(10);
        return view('admin.advertisement.index', compact('advertisements'));
    }
}
