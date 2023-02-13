<?php

namespace App\Http\Enums;

use App\Http\Enums\EnumManagers\CapacityEnumManager;
use App\Http\Interfaces\Enums\EnumCoefficients;

enum CapacityEnum: string implements EnumCoefficients
{
    case milliliter = 'ml';
    case liter = 'l';

    public function coefficient(): int
    {
        return match ($this){
            CapacityEnum::milliliter => 1,
            CapacityEnum::liter => 1000,
        };
    }

    public function convertTo($value, CapacityEnum $from, CapacityEnum $to)
    {
        return $value * ($from->coefficient() / $to->coefficient());
    }
}
