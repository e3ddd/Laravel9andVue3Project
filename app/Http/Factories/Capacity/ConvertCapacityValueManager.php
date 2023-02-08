<?php

namespace App\Http\Factories\Capacity;

use App\Http\Enums\CapacityEnum;
use App\Http\Factories\ConvertProductValuesFactory;

class ConvertCapacityValueManager extends ConvertProductValuesFactory
{
    private CapacityEnum $capacityEnum;
    private float $value;
    private string $type;

    public function __construct(CapacityEnum $capacityEnum, float $value, string $type)
    {

        $this->capacityEnum = $capacityEnum;
        $this->value = $value;
        $this->type = $type;
    }

    public function convertValue()
    {
        return new ConvertCapacityValues($this->capacityEnum, $this->value, $this->type);
    }
}
