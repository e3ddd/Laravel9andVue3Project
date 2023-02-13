<?php

namespace App\Http\Enums\EnumManagers;

use App\Http\Enums\CapacityEnum;
use App\Http\Interfaces\Enums\EnumManager;

class CapacityEnumManager implements EnumManager
{
    private CapacityEnum $from;
    private float $value;
    public function __construct (CapacityEnum $from, float $value)
    {
        $this->from = $from;
        $this->value = $value;
    }

    public function toString(): string
    {
        return $this->value . " " . $this->from->value;
    }
}
