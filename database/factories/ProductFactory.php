<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => rand(1,10),
            'subcategory_id' => rand(1,10),
            'name' => Str::random(10),
            'price' => rand(1000,10000),
            'description' => Str::random(100),
            'user_id' => 1
        ];
    }
}
