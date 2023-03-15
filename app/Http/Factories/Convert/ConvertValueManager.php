<?php

namespace App\Http\Factories\Convert;


use App\Http\Enums\EnumManagers\CapacityEnumManager;
use App\Http\Enums\EnumManagers\DimensionsEnumManager;
use App\Http\Enums\EnumManagers\MemoryEnumManager;
use App\Http\Enums\EnumManagers\PriceEnumManager;
use App\Http\Enums\EnumManagers\WeightEnumManager;
use App\Http\Enums\MagnitudeEnums\CapacityEnum;
use App\Http\Enums\MagnitudeEnums\DimensionsEnum;
use App\Http\Enums\MagnitudeEnums\MemoryValuesEnum;
use App\Http\Enums\MagnitudeEnums\PriceEnum;
use App\Http\Enums\MagnitudeEnums\WeightEnum;
use App\Http\Factories\Validate\NumericType;

class ConvertValueManager extends NumericType
{
    public function isNumeric($value)
    {
        return is_numeric($value);
    }

    public function for(PriceEnum | DimensionsEnum | WeightEnum | MemoryValuesEnum | CapacityEnum $from, $value)
    {

        if ($this->isNumeric($value)){
            switch (get_class($from)) {
                case DimensionsEnum::class:
                    return new DimensionsEnumManager($from, $value);
                case WeightEnum::class:
                    return new WeightEnumManager($from, $value);
                case CapacityEnum::class:
                    return new CapacityEnumManager($from, $value);
                case MemoryValuesEnum::class:
                    return new MemoryEnumManager($from, $value);
                case PriceEnum::class:
                    return new PriceEnumManager($from, $value);
            }
        }else{
            throw new \Exception('Bad value format !');
        }

    }

    public function validate($item, $type)
    {
        $enums = [
            DimensionsEnum::class,
            WeightEnum::class,
            CapacityEnum::class,
            PriceEnum::class,
            MemoryValuesEnum::class
        ];

        foreach ($enums as $enum){
            $enumTryFromType = $enum::tryFrom($type);
            if($enumTryFromType !== null){
                return $this->for($enumTryFromType, $item['value'])->convertToSmallest();
            }
        }

    }

    public function getConvertValue($attrValues, $attrsTypes)
    {
        $enums = [
            DimensionsEnum::class,
            WeightEnum::class,
            CapacityEnum::class,
            PriceEnum::class,
            MemoryValuesEnum::class
        ];

        $convertedValues = [];
        foreach ($attrValues as $key => $value){
            if($attrsTypes[$key]['value'] !== 'string' && $attrsTypes[$key]['value'] !== 'number'){
                foreach ($enums as $enum){
                    $enumTryFromType = $enum::tryFrom($attrsTypes[$key]['value']);
                    if($enumTryFromType !== null){
                        $convertedValues[$attrsTypes[$key]['name']] = ['value' => $this->for($enumTryFromType, $value['value'])->convertFromSmallest(),
                                                                       'type' => $attrsTypes[$key]['value']];
                    }
                }
            }else{
                $convertedValues[$attrsTypes[$key]['name']] = ['value' => $value['value'], 'type' => $attrsTypes[$key]['value']];
            }
        }

        return $convertedValues;
    }

}
