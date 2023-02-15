<?php

namespace App\Http\Factories\Convert;


use App\Http\Enums\EnumManagers\CapacityEnumManager;
use App\Http\Enums\EnumManagers\DimensionsEnumManager;
use App\Http\Enums\EnumManagers\MemoryEnumManager;
use App\Http\Enums\EnumManagers\WeightEnumManager;
use App\Http\Enums\MagnitudeEnums\CapacityEnum;
use App\Http\Enums\MagnitudeEnums\DimensionsEnum;
use App\Http\Enums\MagnitudeEnums\MemoryValuesEnum;
use App\Http\Enums\MagnitudeEnums\WeightEnum;

class ConvertValueManager
{
    public static function for(DimensionsEnum | WeightEnum | MemoryValuesEnum | CapacityEnum $from, $value)
    {
        switch(get_class($from)){
            case DimensionsEnum::class:
                 return new DimensionsEnumManager($from, $value);
            case WeightEnum::class:
                return new WeightEnumManager($from, $value);
            case CapacityEnum::class:
                return new CapacityEnumManager($from, $value);
            case MemoryValuesEnum::class:
                return new MemoryEnumManager($from, $value);
        }
    }
}
