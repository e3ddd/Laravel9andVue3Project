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

    /**
     * Convert value in a given magnitude
     * @param WeightEnum $to
     * @return float|int
     */
    public function convertTo(WeightEnum $to)
    {
        return $this->value * ($this->from->coefficient() / $to->coefficient());
    }

    /**
     * Convert value to smallest magnitude
     * @return float|int
     */
    public function convertToSmallest()
    {
        return $this->value * ($this->from->coefficient() / WeightEnum::milligram->coefficient());
    }

    /**
     * Convert from smallest magnitude
     * @return float|int
     */
    public function convertFromSmallest()
    {
        return $this->value * (WeightEnum::milligram->coefficient() / $this->from->coefficient());
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
