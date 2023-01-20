<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAllProducts($userId)
    {
        return Product::with('image')
            ->with('user')
            ->where('user_id', $userId)
            ->paginate(5);
    }

    public function getProduct(int $productId): Product
    {
        return Product::find($productId);
    }

    public function createProduct(string $name, int $price, string $description): Product
    {
       $product = collect(['name', 'price', 'description']);
       return Product::create($product->combine([$name, $price, $description])->toArray());
    }

    public function destroyProduct(int $productId): bool
    {
        return Product::destroy($productId);
    }

    public function updateProduct(int $productId, string $name, int $price, string $description)
    {
        $newData = collect(['name', 'price', 'description']);

        return Product::find($productId)->update($newData->combine([$name, $price, $description])->toArray());
    }
}
