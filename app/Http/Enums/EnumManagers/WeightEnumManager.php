<?php

namespace App\Http\Enums\EnumManagers;

use App\Http\Enums\MagnitudeEnums\WeightEnum;
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

    public function convertTo(WeightEnum $to)
    {
        return $this->value * ($this->from->coefficient() / $to->coefficient());
    }

    public function convertToSmallest()
    {
        return $this->value * ($this->from->coefficient() / WeightEnum::milligram->coefficient());
    }

    public function convertFromSmallest()
    {
        return $this->value * (WeightEnum::milligram->coefficient() / $this->from->coefficient());
    }

    public function toString(): string
    {
        return $this->value . " " . $this->from->value;
    }
}
