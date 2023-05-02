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

    /**
     * Convert value in a given magnitude
     * @param DimensionsEnum $to
     * @return float|int
     */
    public function convertTo(DimensionsEnum $to)
    {
        return $this->value * ($this->from->coefficient() / $to->coefficient());
    }

    /**
     * Convert value to smallest magnitude
     * @return float|int
     */
    public function convertToSmallest()
    {
        return $this->value * ($this->from->coefficient() / DimensionsEnum::millimeter->coefficient());
    }

    /**
     * Convert from smallest magnitude
     * @return float|int
     */
    public function convertFromSmallest()
    {
        return $this->value * (DimensionsEnum::millimeter->coefficient() / $this->from->coefficient());
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
