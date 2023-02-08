<?php

namespace App\Http\Factories\Capacity;

use App\Http\Enums\CapacityEnum;
use App\Http\Interfaces\ConvertInterface;

class ConvertCapacityValues implements ConvertInterface
{
    private CapacityEnum $unit;
    private float $value;
    private string $type;

    public function __construct(CapacityEnum $unit, float $value, string $type)
    {
        $this->unit = $unit;
        $this->value = $value;
        $this->type = $type;
    }

    public function convertToMilliliter()
    {
        return match ($this->unit){
            CapacityEnum::liter => $this->value / 1000,
            default => $this->value,
        };
    }
    public function convertToLiter()
    {
        return match ($this->unit){
            CapacityEnum::milliliter => $this->value * 1000,
            default => $this->value,
        };
    }

    public function convertType()
    {
        return match ($this->type){
            'milliliters' => $this->convertToMilliliter(),
            'liters' => $this->convertToLiter(),
        };
    }
}
