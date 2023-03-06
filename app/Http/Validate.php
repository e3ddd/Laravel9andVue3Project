<?php

namespace App\Http;

use App\Http\Enums\MagnitudeEnums\CapacityEnum;
use App\Http\Enums\MagnitudeEnums\DimensionsEnum;
use App\Http\Enums\MagnitudeEnums\MemoryValuesEnum;
use App\Http\Enums\MagnitudeEnums\PriceEnum;
use App\Http\Enums\MagnitudeEnums\WeightEnum;
use App\Http\Factories\Convert\ConvertValueManager;

class Validate
{
    public function validate($item, $type)
    {
        $dimension = DimensionsEnum::tryFrom($type);
        $weight = WeightEnum::tryFrom($type);
        $capacity = CapacityEnum::tryFrom($type);
        $price = PriceEnum::tryFrom($type);
        $memory = MemoryValuesEnum::tryFrom($type);

        $enums = [$dimension, $weight, $capacity, $price, $memory];

        foreach ($enums as $enum){
            if(isset($enum)){
                if (is_numeric($item['value'])) {
                    $validNum = ConvertValueManager::for($enum, $item['value'])->convertToSmallest();
                } else {
                    throw new \Exception('Bad ' . $item['name'] . ' value format !');
                }
                return $validNum;
            }
        }

    }
}
