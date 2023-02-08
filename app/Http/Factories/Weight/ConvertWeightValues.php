<?php

namespace App\Http\Factories\Weight;

use App\Http\Enums\WeightEnum;
use App\Http\Interfaces\ConvertInterface;

class ConvertWeightValues implements ConvertInterface
{
    private WeightEnum $unit;
    private float $value;
    private string $type;

    public function __construct(WeightEnum $unit, float $value, string $type)
    {
        $this->unit = $unit;
        $this->value = $value;
        $this->type = $type;
    }

    public function convertToMilligrams()
    {
        return match ($this->unit){
            WeightEnum::gram => $this->value / 1000,
            WeightEnum::kilogram => $this->value / 1000000,
            WeightEnum::ton => $this->value / 1000000000,
            default => $this->value,
        };
    }
    public function convertToGrams()
    {
        return match ($this->unit){
            WeightEnum::milligram => $this->value * 1000,
            WeightEnum::kilogram => $this->value  / 1000,
            WeightEnum::ton => $this->value / 1000000,
            default => $this->value,
        };
    }
    public function convertToKilograms()
    {
        return match ($this->unit){
            WeightEnum::milligram => $this->value * 1000000,
            WeightEnum::gram => $this->value * 1000,
            WeightEnum::ton => $this->value / 1000,
            default => $this->value,
        };
    }
    public function convertToTons()
    {
        return match ($this->unit){
            WeightEnum::milligram => $this->value * 1000000000,
            WeightEnum::gram => $this->value * 1000000,
            WeightEnum::kilogram => $this->value * 1000,
            default => $this->value,
        };
    }

    public function convertType()
    {
        return match ($this->type){
            'milligrams' => $this->convertToMilligrams(),
            'grams' => $this->convertToGrams(),
            'kilograms' => $this->convertToKilograms(),
            'tons' => $this->convertToTons(),
        };
    }
}
