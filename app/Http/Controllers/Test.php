<?php

namespace App\Http\Controllers;


use App\Http\Enums\MagnitudeEnums\DimensionsEnum;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;


class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }

    public function index(Request $request)
    {
        return $request;
    }
}

