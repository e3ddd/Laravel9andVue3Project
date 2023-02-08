<?php

namespace App\Http\Factories\Memory;

use App\Http\Enums\MemoryValuesEnum;
use App\Http\Factories\ConvertProductValuesFactory;

class ConvertMemoryValueManager extends ConvertProductValuesFactory
{
    private MemoryValuesEnum $memoryValuesEnum;
    private float $value;
    private string $type;

    public function __construct(MemoryValuesEnum $memoryValuesEnum, float $value, string $type)
    {
        $this->memoryValuesEnum = $memoryValuesEnum;
        $this->value = $value;
        $this->type = $type;
    }
    public function convertValue()
    {
        return new ConvertMemoryValues($this->memoryValuesEnum, $this->value, $this->type);
    }
}
