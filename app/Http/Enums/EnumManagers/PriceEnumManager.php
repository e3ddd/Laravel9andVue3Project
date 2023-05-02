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

    /**
     * Convert value in a given magnitude
     * @param PriceEnum $to
     * @return float|int
     */
    public function convertTo(PriceEnum $to)
    {
        return $this->value * ($this->from->coefficient() / $to->coefficient());
    }

    /**
     * Convert value to smallest magnitude
     * @return float|int
     */
    public function convertToSmallest()
    {
        return $this->value * ($this->from->coefficient() / PriceEnum::coin->coefficient());
    }

    /**
     * Convert from smallest magnitude
     * @return float|int
     */
    public function convertFromSmallest()
    {
        return $this->value * (PriceEnum::coin->coefficient() / $this->from->coefficient());
    }

    /**
     * Format to string
     * @return string
     */
    public function toString(): string
    {
        return $this->value . " " . $this->from->value;
    }
}
