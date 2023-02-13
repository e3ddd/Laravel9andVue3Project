<?php

namespace App\Http\Products;

use App\Http\Factories\Convert\ConvertValueManager;

class MainProductCharacters
{
    private string $name;
    private int|float $price;
    private string $producer;
    private string $type;


    public function __construct(string $name, int|float $price, string $producer, string $type, int|array $size)
    {
        $this->name = $name;
        $this->producer = $producer;
        $this->price = $price;
        $this->type = $type;
    }

    public function get()
    {
        return [
            'name' => $this->name,
            'producer' => $this->producer,
            'price' => $this->price,
            'type' => $this->type,
        ];
    }


}
