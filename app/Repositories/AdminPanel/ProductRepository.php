<?php

namespace App\Repositories\AdminPanel;

use App\Models\Category;
use App\Models\Product;

class ProductRepository
{
    public function getProductByName($productName)
    {
        return Product::where('name', $productName)->first();
    }

    public function getProductById($productId)
    {
        return Product::with('image')->find($productId);
    }

    public function getAllProducts()
    {
        return Product::all();
    }

    public function getAllProductsByCategoryName($categoryName)
    {
        $categoryId = Category::where('name', $categoryName)->first()->id;
        $subcategories = Category::where('parent_id', $categoryId)->get('id')->toArray();

        return Product::whereIn('subcategory_id', $subcategories)->with('image')->with('attribute')->paginate(9);
    }

    public function getAllProductBySubcategoryNameWithPaginate($subcategoryName)
    {
        $subcategoryId = Category::where('name', $subcategoryName)->first()->id;

        return Product::where('subcategory_id', $subcategoryId)->with('image')->with('attribute')->paginate(9);
    }

    public function getAllProductBySubcategoryIdWithPaginate($subcategoryId)
    {
        return Product::where('subcategory_id', $subcategoryId)->with('image')->paginate(10);
    }

    public function searchProduct($search)
    {
        return Product::where('name', 'like', '%' . $search . '%')->with('image')->get();
    }

    public function searchProductBySubcategory($search, $subcategoryId)
    {
        return Product::where('name', 'like', '%' . $search . '%')->where('subcategory_id', $subcategoryId)->paginate(10);
    }

    public function deleteProduct($productId)
    {
        Product::destroy($productId);
    }

    public function storeProduct($productName, $productPrice, $productProducer, $productDescription, $subcategoryId)
    {
        if(Product::where('name', $productName)->exists()){
            throw new \Exception('Product name exist !');
        }else{
            Product::create([
                'name' => $productName,
                'price' => $productPrice,
                'producer' => $productProducer,
                'description' => $productDescription,
                'subcategory_id' => $subcategoryId
            ]);
        }
    }
}
