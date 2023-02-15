<?php

namespace App\Http\Enums\MagnitudeEnums;

use App\Http\Interfaces\Enums\EnumCoefficients;

enum MemoryValuesEnum: string implements EnumCoefficients
{
    case kilobyte = 'kb';
    case megabyte = 'mb';
    case gigabyte = 'gb';
    case terabyte = 'tb';

    public function coefficient(): int
    {
        return match ($this){
            MemoryValuesEnum::kilobyte => 1,
            MemoryValuesEnum::megabyte => 1000,
            MemoryValuesEnum::gigabyte => 1000000,
            MemoryValuesEnum::terabyte => 1000000000,
        };
    }
}
