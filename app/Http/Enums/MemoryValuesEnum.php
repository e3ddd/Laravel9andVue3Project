<?php

namespace App\Http\Enums;

enum MemoryValuesEnum: string
{
    case kilobyte = 'kb';
    case megabyte = 'mb';
    case gigabyte = 'gb';
    case terabyte = 'tb';
}
