<?php

namespace App\Http\Factories;


abstract class ConvertProductValuesFactory
{
    abstract public function convertValue();

    public function getResult()
    {
        $res = $this->convertValue();

        return $res->convertType();
    }
}
