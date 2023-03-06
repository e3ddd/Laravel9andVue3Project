<?php

namespace App\Http\Controllers;


use App\Http\CreateProductClass;
use App\Http\Enums\MagnitudeEnums\DimensionsEnum;
use App\Http\Enums\MagnitudeEnums\WeightEnum;
use App\Http\Factories\Convert\ConvertValueManager;
use App\Http\Traits\ValidateTrait;
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
        $validPrice = new CreateProductClass();
        dd($validPrice->validatePrice(100.332));
    }
}

