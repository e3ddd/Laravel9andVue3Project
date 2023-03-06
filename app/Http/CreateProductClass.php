<?php

namespace App\Http;

use App\Http\Enums\MagnitudeEnums\CapacityEnum;
use App\Http\Enums\MagnitudeEnums\DimensionsEnum;
use App\Http\Enums\MagnitudeEnums\MemoryValuesEnum;
use App\Http\Enums\MagnitudeEnums\PriceEnum;
use App\Http\Enums\MagnitudeEnums\WeightEnum;
use App\Http\Factories\Convert\ConvertValueManager;

class CreateProductClass
{
    public function validatePrice($priceValue)
    {
        $price = explode('.', $priceValue);
        if(strlen($price[1]) > 2){
            throw new \Exception('Coins value must be not higher than 99 !');
        }else{
            return $priceValue;
        }
    }

    public function validate($values, PriceEnum | DimensionsEnum |
                                             WeightEnum | MemoryValuesEnum | CapacityEnum $tryFrom,
                                             PriceEnum | DimensionsEnum |
                                             WeightEnum | MemoryValuesEnum | CapacityEnum $to)
    {
        $validValues = [];
        foreach ($values as $value) {
            if ($value['type'] != 'string') {
                if(is_numeric($value['value'])){
                    $validValues[$value['name']] = ConvertValueManager::for($tryFrom, $value['value'])->convertTo($to);
                }else{
                    throw new \Exception('Bad ' . $value['name'] . ' format !');
                }
            } else {
                $validValues[$value['name']] = $value['value'];
            }
        }
        return $validValues;
    }

}
