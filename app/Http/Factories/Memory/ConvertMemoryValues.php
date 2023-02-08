<?php

namespace App\Http\Factories\Memory;

use App\Http\Enums\MemoryValuesEnum;
use App\Http\Interfaces\ConvertInterface;

class ConvertMemoryValues implements ConvertInterface
{
    private MemoryValuesEnum $unit;
    private float $value;
    private string $type;

    public function __construct(MemoryValuesEnum $unit, float $value, string $type)
    {
        $this->unit = $unit;
        $this->value = $value;
        $this->type = $type;
    }

    public function convertToKilobytes()
    {
        return match ($this->unit){
            MemoryValuesEnum::megabyte => $this->value / 1000,
            MemoryValuesEnum::gigabyte => $this->value / 100000,
            MemoryValuesEnum::terabyte => $this->value / 100000000,
            default => $this->value
        };
    }
    public function convertToMegabytes()
    {
        return match ($this->unit){
            MemoryValuesEnum::kilobyte => $this->value * 1000,
            MemoryValuesEnum::gigabyte => $this->value / 1000,
            MemoryValuesEnum::terabyte => $this->value / 1000000,
            default => $this->value
        };
    }
    public function convertToGigabytes()
    {
        return match ($this->unit){
            MemoryValuesEnum::kilobyte => $this->value * 1000000,
            MemoryValuesEnum::megabyte => $this->value * 1000,
            MemoryValuesEnum::terabyte => $this->value / 1000,
            default => $this->value
        };
    }
    public function convertToTerabytes()
    {
        return match ($this->unit){
            MemoryValuesEnum::kilobyte => $this->value * 1000000000,
            MemoryValuesEnum::megabyte => $this->value * 1000000,
            MemoryValuesEnum::gigabyte => $this->value * 1000,
            default => $this->value
        };
    }

    public function convertType()
    {
        return match ($this->type){
            'kilobytes' => $this->convertToKilobytes(),
            'megabytes' => $this->convertToMegabytes(),
            'gigabytes' => $this->convertToGigabytes(),
            'terabytes' => $this->convertToTerabytes(),
        };
    }
}
