<?php

namespace App\Http\Factories\Dimensions;

use App\Http\Enums\DimensionsEnum;
use App\Http\Factories\ConvertProductValuesFactory;

class CreateConvertDimension extends ConvertProductValuesFactory
{
    private DimensionsEnum $unit;
    private float $value;

    public function __construct(DimensionsEnum $unit,float $value)
    {
        $this->unit = $unit;
        $this->value = $value;
    }
    public function convertValue(): ConvertDimensionValues
    {
        return new ConvertDimensionValues($this->unit, $this->value);
    }
}
