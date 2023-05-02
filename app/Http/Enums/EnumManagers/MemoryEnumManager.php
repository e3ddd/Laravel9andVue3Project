<?php

namespace App\Http\Enums\EnumManagers;

use App\Http\Enums\MagnitudeEnums\MemoryValuesEnum;
use App\Http\Interfaces\Enums\EnumManager;

class MemoryEnumManager implements EnumManager
{
    private MemoryValuesEnum $from;
    private float $value;

    public function __construct (MemoryValuesEnum $from, float $value)
    {
        $this->from = $from;
        $this->value = $value;
    }

    /**
     * Convert value in a given magnitude
     * @param MemoryValuesEnum $to
     * @return float|int
     */
    public function convertTo(MemoryValuesEnum $to)
    {
        return $this->value * ($this->from->coefficient() / $to->coefficient());
    }

    /**
     * Convert value to smallest magnitude
     * @return float|int
     */
    public function convertToSmallest()
    {
        return $this->value * ($this->from->coefficient() / MemoryValuesEnum::kilobyte->coefficient());
    }

    /**
     * Convert from smallest magnitude
     * @return float|int
     */
    public function convertFromSmallest()
    {
        return $this->value * (MemoryValuesEnum::kilobyte->coefficient() / $this->from->coefficient());
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
