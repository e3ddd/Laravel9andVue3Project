<?php

namespace App\Http\Factories;

use App\Http\Enums\DimensionsEnum;

class ProductDimensionFactory
{

    private DimensionsEnum $unit;
    private array $values;

    public function __construct(DimensionsEnum $unit ,array $values)
    {
        $this->unit = $unit;
        $this->values = $values;
    }


    public function convert(): array
    {
        $newValues = [];
        foreach ($this->values as $key => $value){
            if($this->unit->name == 'millimeter'){
                $newValues[] = [$key => $value / 10];
            }
            else if($this->unit->name == 'meter'){
                $newValues[] = [$key => $value * 100];
            }
            else {
                return $this->values;
            }
        }
        return $newValues;
    }

}
