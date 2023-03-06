<?php

namespace App\Http\Enums\EnumManagers;

use App\Http\Enums\MagnitudeEnums\PriceEnum;
use App\Http\Interfaces\Enums\EnumManager;

class PriceEnumManager implements EnumManager
{
    private PriceEnum $from;
    private float $value;

    public function __construct (PriceEnum $from, float $value)
    {
        $this->from = $from;
        $this->value = $value;
    }

    public function convertTo(PriceEnum $to)
    {
        return $this->value * ($this->from->coefficient() / $to->coefficient());
    }

    public function convertToSmallest()
    {
        return $this->value * ($this->from->coefficient() / PriceEnum::coin->coefficient());
    }
    public function toString(): string
    {
        return $this->value . " " . $this->from->value;
    }
}
