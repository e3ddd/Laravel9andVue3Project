<?php

namespace App\Http\Controllers;

use App\Http\Enums\CapacityEnum;
use App\Http\Enums\DimensionsEnum;
use App\Http\Enums\WeightEnum;
use App\Http\Factories\Convert\ConvertProductValuesFactory;
use App\Http\Factories\Convert\ConvertValueManager;
use Exception;
use Illuminate\Http\Request;


class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }

    public function getConvertFactory(ConvertProductValuesFactory $factory)
    {
        return $factory->getResult();
    }

    public function index(Request $request)
    {

        $from = DimensionsEnum::tryFrom($request->dimensionType)
            ?? throw new Exception('Invalid convert value !', 404);

        $convertedValues = [];

        foreach ($request->dimensionValues as $value){
           $convertedValues[] = $this->getConvertFactory(new ConvertValueManager($from, DimensionsEnum::millimeter, $value));
        }

        return $convertedValues;
    }
}

