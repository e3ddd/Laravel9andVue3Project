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


        $enums = [DimensionsEnum::class,  WeightEnum::class,
                  CapacityEnum::class, PriceEnum::class, MemoryValuesEnum::class];

        foreach ($enums as $enum){
            $tryFrom = $enum::tryFrom($type);
            if(isset($tryFrom)){
                if (is_numeric($item['value'])) {
                    $validNum = ConvertValueManager::for($tryFrom, $item['value'])->convertToSmallest();
                } else {
                    throw new \Exception('Bad ' . $item['name'] . ' value format !');
                }
                return $validNum;
            }
        }

    }
}
