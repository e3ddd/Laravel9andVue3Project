<?php

namespace App\Http\Enums;

use App\Http\Interfaces\EnumCoefficients;

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
