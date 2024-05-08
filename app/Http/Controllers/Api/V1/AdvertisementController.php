<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index()
    {
        $datas = Advertisement::with(['additional_fields' => function ($query) {
            $query->take(2);
        }])
            ->get();

        return $datas;
    }
    public function show(Request $request)
    {
        $datas = Advertisement::with('fields')
            ->where('id', $request->id)
            ->get();

        if ($datas) {
            return response()->json([
                'success' => true,
                'data' => $datas
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }
}
