<?php

namespace App\Http\Controllers;

use App\Http\Enums\MagnitudeEnums\PriceEnum;
use App\Http\Factories\Convert\ConvertValueManager;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Services\AdminPanel\CategoriesAndAttributesService;
use App\Services\AdminPanel\ProductService;
use Illuminate\Http\Request;
use Vonage\Account\Price;

class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }

    public function index(Request $request)
    {
       $productService = app(ProductService::class);

       dump($productService->getProductById(6));
    }
}

