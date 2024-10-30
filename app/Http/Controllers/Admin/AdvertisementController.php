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
    public function show($id)
    {
        $advertisement = Advertisement::where('id', $id)->first();
        return view('admin.advertisement.show', compact('advertisement'));
    }
    public function publish($id)
    {
        $advertisement = Advertisement::where('id', $id)->first();
        $advertisement->status = 1;
        $advertisement->update();
        return redirect()->back()->with('message', 'Ads has ben published');
    }
    public function draft($id)
    {
        $advertisement = Advertisement::where('id', $id)->first();
        $advertisement->status = 0;
        $advertisement->update();
        return redirect()->back()->with('message', 'Ads has ben save draft');
    }
    public function trash($id)
    {
        $advertisement = Advertisement::where('id', $id)->first();
        $advertisement->status = 3;
        $advertisement->update();
        return redirect()->back()->with('message', 'Ads has ben delete to trash');
    }
}
