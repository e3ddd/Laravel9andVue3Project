<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;


class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }

    public function index(Request $request)
    {
        dump(Product::whereIn('subcategory_id', 2,3)->get());
    }
}

