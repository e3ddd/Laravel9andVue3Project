<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductRepository
{
    public function getAllUserProducts()
    {
        return Product::with('image')
            ->with('user')
            ->where('user_id', Auth::user()->id)
            ->paginate(10);
    }

    public function getProductsByCategory($name)
    {
        $category_id = Category::where('name', $name)->first()->toArray()['id'];

        return Product::where('category_id', $category_id)
            ->with('image')
            ->with('user')
            ->with('category')
            ->paginate(9);
    }

    public function getProductsBySubcategory($name)
    {
        $category_id = Subcategory::where('name', $name)->first()->toArray()['id'];

        return Product::where('subcategory_id', $category_id)
            ->with('image')
            ->with('user')
            ->with('category')
            ->paginate(9);
    }

    public function getAllProducts()
    {
        return Product::with('image')
            ->with('user')
            ->with('category')
            ->paginate(9);
    }

    public function getProduct($productId): Product
    {
        return Product::find($productId);
    }

    public function getUserIdByEmail($userEmail)
    {
        return User::where('email', $userEmail)->first('id');
    }
    public function createProduct($category, $subcategory, $userId, $name, $price, $description): Product
    {
        $categoryId = Category::where('name', $category)->first('id')->toArray()['id'];
        $subcategoryId = Subcategory::where('name', $subcategory)->first('id')->toArray()['id'];

        return Product::create([
           "category_id" => $categoryId,
           'subcategory_id' => $subcategoryId,
           "user_id" => $userId,
           "name" => $name,
           "price" => $price,
           "description" => $description]);
    }

    public function destroyProduct($productId): bool
    {
        return Product::destroy($productId);
    }

    public function updateProduct($productId, $name, $price, $description)
    {

        return Product::find($productId)->update([$name, $price, $description]);
    }
}