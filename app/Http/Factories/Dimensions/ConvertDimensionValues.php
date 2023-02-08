<?php

namespace App\Http\Factories\Dimensions;

use App\Http\Enums\DimensionsEnum;
use App\Http\Interfaces\ConvertInterface;


class ConvertDimensionValues implements ConvertInterface
{
    private DimensionsEnum $unit;
    private float $value;
    private string $type;

    public function __construct(DimensionsEnum $unit, float $value, string $type)
    {
        $this->unit = $unit;
        $this->value = $value;
        $this->type = $type;
    }

    public function convertToMillimeters()
    {
        return match ($this->unit){
          DimensionsEnum::centimeter => $this->value / 10,
          DimensionsEnum::meter => $this->value / 1000,
          default => $this->value,
        };
    }
    public function convertToCentimeters()
    {
        return match ($this->unit){
            DimensionsEnum::millimeter => $this->value * 10,
            DimensionsEnum::meter => $this->value / 100,
            default => $this->value,
        };
    }
    public function convertToMeters()
    {
        return match ($this->unit){
            DimensionsEnum::millimeter => $this->value * 1000,
            DimensionsEnum::centimeter => $this->value * 100,
            default => $this->value,
        };
    }

    public function convertType()
    {
        return match ($this->type){
          'millimeters' => $this->convertToMillimeters(),
          'centimeters' => $this->convertToCentimeters(),
          'meters' => $this->convertToMeters(),
        };
    }
}
