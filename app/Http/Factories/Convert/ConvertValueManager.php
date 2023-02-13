<?php

namespace App\Http\Factories\Convert;


use App\Http\Enums\CapacityEnum;
use App\Http\Enums\DimensionsEnum;
use App\Http\Enums\EnumManagers\CapacityEnumManager;
use App\Http\Enums\EnumManagers\DimensionsEnumManager;
use App\Http\Enums\EnumManagers\MemoryEnumManager;
use App\Http\Enums\EnumManagers\WeightEnumManager;
use App\Http\Enums\MemoryValuesEnum;
use App\Http\Enums\WeightEnum;

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
