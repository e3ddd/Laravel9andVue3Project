<?php

namespace App\Http\Enums;

enum WeightEnum: string
{
    case milligram = 'mm';
    case gram = 'g';
    case kilogram = 'kg';
    case ton = 't';
}
