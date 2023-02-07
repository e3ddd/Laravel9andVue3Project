<?php

namespace App\Http\Factories;

use App\Http\Enums\DimensionsEnum;

class ProductDimensionFactory
{

    private DimensionsEnum $unit;
    private float $value;

    public function __construct(DimensionsEnum $unit ,float $value)
    {
        $this->unit = $unit;
        $this->value = $value;
    }

    public function convertToMillimeter(): DimensionsEnum|float|int
    {
        return match ($this->unit) {
            DimensionsEnum::centimeter => $this->value * 10,
            DimensionsEnum::meter => $this->value * 1000,
            default => $this->value
        };
    }

    public function convertToCentimeter(): DimensionsEnum|float|int
    {
        return match ($this->unit) {
            DimensionsEnum::millimeter => $this->value / 10,
            DimensionsEnum::meter => $this->value / 100,
            default => $this->value
        };
    }

    public function convertToMeter(): DimensionsEnum|float|int
    {
        return match ($this->unit) {
            DimensionsEnum::centimeter => $this->value / 100,
            DimensionsEnum::millimeter => $this->value / 1000,
            default => $this->value
        };
    }



}
