<?php

namespace App\Http\Factories\Convert;

use App\Http\Enums\CapacityEnum;
use App\Http\Enums\DimensionsEnum;
use App\Http\Enums\MemoryValuesEnum;
use App\Http\Enums\WeightEnum;
use App\Http\Interfaces\ConvertInterface;

class ConvertValue implements ConvertInterface
{
    private CapacityEnum | DimensionsEnum | WeightEnum | MemoryValuesEnum $from;
    private CapacityEnum | DimensionsEnum | WeightEnum | MemoryValuesEnum $to;
    private float $value;

    public function __construct(CapacityEnum | DimensionsEnum | WeightEnum | MemoryValuesEnum $from,
                                CapacityEnum | DimensionsEnum | WeightEnum | MemoryValuesEnum $to,
                                float $value)
    {
        $this->from = $from;
        $this->to = $to;
        $this->value = $value;
    }

    public function convertTo()
    {
         return $this->value * ($this->from->coefficient() / $this->to->coefficient());
    }
}
