<?php

namespace App\Http\Controllers;

use App\Http\Enums\MagnitudeEnums\PriceEnum;
use App\Http\Factories\Convert\ConvertValueManager;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Repositories\AdminPanel\ProductRepository;
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
        dd(urldecode('lumber%20and%20wood%20boards'));
        $test = new ProductRepository();
        dump($test->getAllProductsByCategory());
    }
}

