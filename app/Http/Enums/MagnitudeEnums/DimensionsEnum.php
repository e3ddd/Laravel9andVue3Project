<?php

namespace App\Http\Enums\MagnitudeEnums;

use App\Http\Interfaces\Enums\EnumCoefficients;

enum DimensionsEnum: string implements EnumCoefficients
{
    case millimeter = 'mm';
    case centimeter = 'cm';
    case meter = 'm';

    public function coefficient(): int
    {
       return match ($this){
         DimensionsEnum::millimeter => 1,
         DimensionsEnum::centimeter => 10,
         DimensionsEnum::meter => 1000,
       };
    }
}
