<?php

namespace App\Http\Enums\EnumManagers;

use App\Http\Enums\MagnitudeEnums\CapacityEnum;
use App\Http\Interfaces\Enums\EnumManager;
use Illuminate\Validation\ValidationException;

class CapacityEnumManager implements EnumManager
{
    private CapacityEnum $from;
    private float $value;
    public function __construct (CapacityEnum $from, float $value)
    {
        $this->from = $from;
        $this->value = $value;
    }

    public function convertTo(CapacityEnum $to)
    {
        return $this->value * ($this->from->coefficient() / $to->coefficient());
    }

    public function convertToSmallest()
    {
        return $this->value * ($this->from->coefficient() / CapacityEnum::milliliter->coefficient());
    }

    public function convertFromSmallest()
    {
        return $this->value * (CapacityEnum::milliliter->coefficient() / $this->from->coefficient());
    }

    public function toString(): string
    {
        return $this->value . " " . $this->from->value;
    }
}
