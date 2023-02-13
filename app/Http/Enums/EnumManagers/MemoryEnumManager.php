<?php

namespace App\Http\Enums\EnumManagers;

use App\Http\Enums\MemoryValuesEnum;
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
    public function toString(): string
    {
        return $this->value . " " . $this->from->value;
    }
}
