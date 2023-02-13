<?php

namespace App\Http\Enums\EnumManagers;

use App\Http\Enums\DimensionsEnum;
use App\Http\Interfaces\Enums\EnumManager;

class DimensionsEnumManager implements EnumManager
{
    private DimensionsEnum $from;
    private float $value;

    public function __construct (DimensionsEnum $from, float $value)
    {
        $this->from = $from;
        $this->value = $value;
    }
    public function toString(): string
    {
        return $this->value . " " . $this->from->value;
    }
}
