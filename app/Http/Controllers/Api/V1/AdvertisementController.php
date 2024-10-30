<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Image;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index()
    {
        $datas = Advertisement::with(['additional_fields' => function ($query) {
            $query->take(2);
        }])
            ->orderBy('advertisements.id', 'desc')
            ->where('status', 1)
            ->join('images', 'advertisements.id', '=', 'images.advertisement_id')
            ->select('advertisements.*', 'images.image_url as image_url')
            ->paginate(10);

        // return response()->json($datas);

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
    public function show($id)
    {
        $datas = Advertisement::with('additional_fields', 'images')
            ->where('id', $id)
            ->first();

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

        $this->images($datas);
    }

    public function images($id)
    {
        $images = Image::where('advertisement_id', $id)->get();
        if ($images) {
            return response()->json([
                'success' => true,
                'data' => $images
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }
}
