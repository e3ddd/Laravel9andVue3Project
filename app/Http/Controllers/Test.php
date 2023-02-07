<?php

namespace App\Http\Controllers;


use App\Http\Enums\DimensionsEnum;
use App\Http\Factories\ConvertProductValuesFactory;
use App\Http\Factories\Dimensions\CreateConvertDimension;
use Illuminate\Http\Request;


class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }

    public function getConvertValue(ConvertProductValuesFactory $factory)
    {
        return $factory->getResult();
    }
    public function index(Request $request)
    {
        return $this->getConvertValue(new CreateConvertDimension(DimensionsEnum::meter, 10));
    }
}

