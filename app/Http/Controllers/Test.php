<?php

namespace App\Http\Controllers;

use App\Http\Enums\CapacityEnum;
use App\Http\Enums\DimensionsEnum;
use App\Http\Enums\MemoryValuesEnum;
use App\Http\Enums\WeightEnum;
use App\Http\Factories\Capacity\ConvertCapacityValueManager;
use App\Http\Factories\ConvertProductValuesFactory;
use App\Http\Factories\Dimensions\ConvertDimensionValueManager;
use App\Http\Factories\Memory\ConvertMemoryValueManager;
use App\Http\Factories\Weight\ConvertWeightValueManager;
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
         dump($this->getConvertFactory(new ConvertDimensionValueManager(DimensionsEnum::millimeter, 1, 'centimeters')));
         dump($this->getConvertFactory(new ConvertDimensionValueManager(DimensionsEnum::centimeter, 1, 'millimeters')));
         dump($this->getConvertFactory(new ConvertDimensionValueManager(DimensionsEnum::meter, 1, 'centimeters')));
         dump($this->getConvertFactory(new ConvertWeightValueManager(WeightEnum::milligram, 1000, 'grams')));
         dump($this->getConvertFactory(new ConvertWeightValueManager(WeightEnum::gram, 1000, 'kilograms')));
         dump($this->getConvertFactory(new ConvertWeightValueManager(WeightEnum::kilogram, 1, 'tons')));
         dump($this->getConvertFactory(new ConvertWeightValueManager(WeightEnum::ton, 1, 'kilograms')));
         dump($this->getConvertFactory(new ConvertMemoryValueManager(MemoryValuesEnum::kilobyte, 1, 'megabytes')));
         dump($this->getConvertFactory(new ConvertMemoryValueManager(MemoryValuesEnum::megabyte, 1, 'gigabytes')));
         dump($this->getConvertFactory(new ConvertMemoryValueManager(MemoryValuesEnum::gigabyte, 1, 'terabytes')));
         dump($this->getConvertFactory(new ConvertMemoryValueManager(MemoryValuesEnum::terabyte, 1, 'gigabytes')));
         dump($this->getConvertFactory(new ConvertCapacityValueManager(CapacityEnum::liter, 1, 'milliliters')));
         dump($this->getConvertFactory(new ConvertCapacityValueManager(CapacityEnum::milliliter, 1, 'liters')));
    }
}

