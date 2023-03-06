<?php

namespace App\Http\Enums\MagnitudeEnums;

enum PriceEnum : string
{
    case banknote = 'banknote';
    case coin = 'coin';

    public function coefficient(): int
    {
        return match ($this){
            PriceEnum::coin => 1,
            PriceEnum::banknote => 100,
        };
    }
}
