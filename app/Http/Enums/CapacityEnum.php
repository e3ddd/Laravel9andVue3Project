<?php

namespace App\Http\Enums;

use App\Http\Interfaces\EnumCoefficients;

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
}
