<?php

namespace App\Http\Factories\Weight;

use App\Http\Enums\WeightEnum;
use App\Http\Factories\ConvertProductValuesFactory;

class ConvertWeightValueManager extends ConvertProductValuesFactory
{
    private WeightEnum $weightEnum;
    private float $value;
    private string $type;


    public function __construct(WeightEnum $weightEnum, float $value, string $type)
    {
        $this->weightEnum = $weightEnum;
        $this->value = $value;
        $this->type = $type;
    }
    public function convertValue()
    {
        return new ConvertWeightValues($this->weightEnum, $this->value, $this->type);
    }
}
