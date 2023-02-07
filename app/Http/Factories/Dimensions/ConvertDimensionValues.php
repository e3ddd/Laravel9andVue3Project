<?php

namespace App\Http\Factories\Dimensions;

use App\Http\Enums\DimensionsEnum;
use App\Http\Interfaces\ConvertInterface;

class ConvertDimensionValues implements ConvertInterface
{
    private DimensionsEnum $unit;
    private float $value;

    public function __construct(DimensionsEnum $unit,float $value)
    {
        $this->unit = $unit;
        $this->value = $value;
    }
    public function convertToMillimeters()
    {
        return match ($this->unit){
          DimensionsEnum::centimeter => $this->value * 10,
          DimensionsEnum::meter => $this->value * 1000,
          default => DimensionsEnum::millimeter,
        };
    }
    public function convertToCentimeters()
    {
        return match ($this->unit){
            DimensionsEnum::millimeter => $this->value / 10,
            DimensionsEnum::meter => $this->value / 100,
            default => DimensionsEnum::centimeter,
        };
    }
    public function convertToMeters()
    {
        return match ($this->unit){
            DimensionsEnum::millimeter => $this->value * 1000,
            DimensionsEnum::centimeter => $this->value * 100,
            default => DimensionsEnum::meter,
        };
    }

    public function convert()
    {
        return $this->convertToMillimeters();
    }
}
