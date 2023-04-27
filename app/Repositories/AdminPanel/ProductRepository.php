<?php

namespace App\Repositories\AdminPanel;

use App\Models\Category;
use App\Models\FavoriteProduct;
use App\Models\Product;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class ProductRepository
{
    public function getProductByName($productName)
    {
        return Product::where('name', $productName)->with('image')->first();
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


    public function saveToFavorite($user_id, $product_id)
    {
        $favProd = FavoriteProduct::where('user_id', $user_id)->where('product_id', $product_id);

        if($favProd->exists()){

            $favProd->delete();

            return false;
        }else{

            FavoriteProduct::create([
                'user_id' => $user_id,
                'product_id' => $product_id
            ]);

            return true;
        }
    }

    public function deleteFromFavorite($favorite_id)
    {
        FavoriteProduct::destroy($favorite_id);
    }

    public function checkFavorite($user_id, $product_id)
    {
        $favProd = FavoriteProduct::where('user_id', $user_id)->where('product_id', $product_id);
        $result = false;

        if($favProd->exists()){
            $result = true;
        }
        return $result;
    }

    public function getFavoriteCount($product_id)
    {
        return FavoriteProduct::where('product_id', $product_id)->count();
    }
}
