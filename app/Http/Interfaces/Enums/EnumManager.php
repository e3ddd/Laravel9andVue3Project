<?php

namespace App\Http\Interfaces\Enums;

interface EnumManager
{

    public function convertToSmallest();
    public function toString(): string;
}
