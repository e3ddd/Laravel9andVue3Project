<?php

namespace App\Http\Enums\EnumManagers;

use App\Http\Enums\MagnitudeEnums\DimensionsEnum;
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

    public function convertTo(DimensionsEnum $to)
    {
        return $this->value * ($this->from->coefficient() / $to->coefficient());
    }

    public function convertToSmallest()
    {
        return $this->value * ($this->from->coefficient() / DimensionsEnum::millimeter->coefficient());
    }

    public function convertFromSmallest()
    {
        return $this->value * (DimensionsEnum::millimeter->coefficient() / $this->from->coefficient());
    }
    public function toString(): string
    {
        return $this->value . " " . $this->from->value;
    }
}
