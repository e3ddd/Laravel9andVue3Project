<?php

namespace App\Http\Factories\Convert;


abstract class ConvertProductValuesFactory
{
    abstract public function convertValue();

    public function getResult()
    {
        $res = $this->convertValue();

        return $res->convertTo();
    }
}
