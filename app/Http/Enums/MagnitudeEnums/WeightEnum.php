<?php

namespace App\Http\Enums\MagnitudeEnums;

use App\Http\Interfaces\Enums\EnumCoefficients;

enum WeightEnum: string implements EnumCoefficients
{
    case milligram = 'mg';
    case gram = 'g';
    case kilogram = 'kg';
    case ton = 't';

    public function coefficient(): int
    {
        return match ($this){
            WeightEnum::milligram => 1,
            WeightEnum::gram => 1000,
            WeightEnum::kilogram => 1000000,
            WeightEnum::ton => 1000000000,
        };
    }

}
