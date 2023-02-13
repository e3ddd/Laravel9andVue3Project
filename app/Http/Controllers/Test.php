<?php

namespace App\Http\Controllers;

use App\Http\Enums\CapacityEnum;
use App\Http\Enums\DimensionsEnum;
use App\Http\Enums\EnumManagers\CapacityEnumManager;
use App\Http\Enums\MemoryValuesEnum;
use App\Http\Enums\WeightEnum;

use App\Http\Factories\Convert\ConvertValueManager;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;


class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }

    public function index(Request $request)
    {
        Product::factory()->count(10)->create();
//        $from = WeightEnum::tryFrom($request->dimensionType) ??
//            throw new Exception('Invalid dimension type !', 404);
//
//        return ConvertValueManager::for($from, $request->dimensionValue)
//            ->convertTo(WeightEnum::kilogram);
    }
}

