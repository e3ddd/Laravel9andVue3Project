<?php

namespace App\Http\Controllers;


use App\Http\Enums\MagnitudeEnums\DimensionsEnum;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Services\AdminPanel\ProductService;
use Illuminate\Http\Request;


class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }

    public function index(Request $request)
    {

       dd(preg_replace('/\s+|\W+|[[:alpha:]]+|\_+/', '', '100 000, 000-000dfsfds--32ffds-f-v-fdb-rth?XCV>K@#Uvdfs'));
    }
}

