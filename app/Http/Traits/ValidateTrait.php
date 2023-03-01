<?php

namespace App\Http\Traits;

trait ValidateTrait
{
    public function validate($values)
    {
        $response = [];
        foreach ($values as $value){
            $response[] = preg_replace('/\s+|\W+|[[:alpha:]]+|\_+/', '', $value);
        }

        return $response;
    }
}
