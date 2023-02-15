<?php

namespace App\Http\Enums\MagnitudeEnums;

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
}
