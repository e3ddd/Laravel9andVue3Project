<?php

namespace App\Http\Enums\EnumManagers;

use App\Http\Enums\WeightEnum;
use App\Http\Interfaces\Enums\EnumManager;

class WeightEnumManager implements EnumManager
{
    private WeightEnum $from;
    private float $value;

    public function __construct (WeightEnum $from, float $value)
    {
        $this->from = $from;
        $this->value = $value;
    }
    public function toString(): string
    {
        return $this->value . " " . $this->from->value;
    }
}
