<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::with('city')
            ->get();
        return $provinces;
    }
    public function show(Request $request)
    {
        $provinces = Province::with('city')
            ->where('id', $request->id)
            ->get();
        return $provinces;
    }
}
