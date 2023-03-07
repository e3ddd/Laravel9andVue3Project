<?php

namespace App\Http\Controllers;


use App\Http\Enums\MagnitudeEnums\CapacityEnum;
use App\Http\Enums\MagnitudeEnums\MemoryValuesEnum;
use App\Http\Enums\MagnitudeEnums\PriceEnum;
use App\Http\Validate;
use App\Http\Enums\MagnitudeEnums\DimensionsEnum;
use App\Http\Enums\MagnitudeEnums\WeightEnum;
use App\Http\Factories\Convert\ConvertValueManager;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
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

        $test = new Validate();
        $type = 'cm';

        $arr = [
            'name' => 'test',
            'value' => 100
        ];

        $dimension = $test->validate($arr, $type);

        dump($dimension);
    }
}

