<?php

namespace App\Http\Enums\EnumManagers;

use App\Http\Enums\MagnitudeEnums\CapacityEnum;
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

    /**
     * Convert value in a given magnitude
     * @param CapacityEnum $to
     * @return float|int
     */
    public function convertTo(CapacityEnum $to)
    {
        return $this->value * ($this->from->coefficient() / $to->coefficient());
    }

    /**
     * Convert value to smallest magnitude
     * @return float|int
     */
    public function convertToSmallest()
    {
        return $this->value * ($this->from->coefficient() / CapacityEnum::milliliter->coefficient());
    }

    /**
     * Convert from smallest magnitude
     * @return float|int
     */
    public function convertFromSmallest()
    {
        return $this->value * (CapacityEnum::milliliter->coefficient() / $this->from->coefficient());
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
