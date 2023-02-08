<?php

namespace App\Http\Factories\Dimensions;

use App\Http\Enums\DimensionsEnum;
use App\Http\Factories\ConvertProductValuesFactory;

class ConvertDimensionValueManager extends ConvertProductValuesFactory
{
    private DimensionsEnum $dimensionsEnum;
    private float $value;
    private string $type;


    public function __construct(DimensionsEnum $dimensionsEnum, float $value, string $type)
    {
        $this->dimensionsEnum = $dimensionsEnum;
        $this->value = $value;
        $this->type = $type;
    }
    public function convertValue()
    {
        return new ConvertDimensionValues($this->dimensionsEnum, $this->value, $this->type);
    }
}
