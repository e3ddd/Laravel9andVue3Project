<?php

namespace App\Http\Enums\EnumManagers;

use App\Http\Enums\MagnitudeEnums\MemoryValuesEnum;
use App\Http\Interfaces\Enums\EnumManager;

class MemoryEnumManager implements EnumManager
{
    private MemoryValuesEnum $from;
    private float $value;

    public function __construct (MemoryValuesEnum $from, float $value)
    {
        $this->from = $from;
        $this->value = $value;
    }

    public function convertTo(MemoryValuesEnum $to)
    {
        return $this->value * ($this->from->coefficient() / $to->coefficient());
    }

    public function convertToSmallest()
    {
        return $this->value * ($this->from->coefficient() / MemoryValuesEnum::kilobyte->coefficient());
    }

    public function convertFromSmallest()
    {
        return $this->value * (MemoryValuesEnum::kilobyte->coefficient() / $this->from->coefficient());
    }

    public function toString(): string
    {
        return $this->value . " " . $this->from->value;
    }

}
