<?php

namespace App\Http\Factories\Validate;

class ValidateStringValue extends StringType
{

    public function isString($value)
    {
        return is_string($value);
    }

    public function validate($value)
    {
        if($this->isString($value)){
            return trim($value);
        }else{
            throw new \Exception("Value isn't string !");
        }
    }
}
