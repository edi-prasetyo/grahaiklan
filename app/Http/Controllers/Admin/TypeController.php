<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::orderBy('id', 'asc')->paginate(10);
        return $types;
        return view('admin.type.index');
    }
    public function create()
    {
        return view();
    }
}
