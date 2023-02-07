<?php

namespace App\Http\Factories;


abstract class ConvertProductValuesFactory
{
    abstract public function convertValue();

    public function getResult()
    {
        $result = $this->convertValue();

        return $result->convert();
    }
}
