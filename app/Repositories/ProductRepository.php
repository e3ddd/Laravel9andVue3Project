<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAllUserProducts($userId)
    {
        return Product::with('image')
            ->with('user')
            ->where('user_id', $userId)
            ->paginate(10);
    }

    public function getAllProducts()
    {
        return Product::with('image')
            ->with('user')
            ->paginate(9);
    }

    public function getProduct(int $productId): Product
    {
        return Product::find($productId);
    }

    public function createProduct($userId, $name, $price, $description): Product
    {
       return Product::create([
           "user_id" => $userId,
           "name" => $name,
           "price" => $price,
           "description" => $description]);
    }

    public function destroyProduct(int $productId): bool
    {
        return Product::destroy($productId);
    }

    public function updateProduct(int $productId, $name, $price, $description)
    {

        return Product::find($productId)->update([$name, $price, $description]);
    }
}
