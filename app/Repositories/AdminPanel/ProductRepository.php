<?php

namespace App\Repositories\AdminPanel;

use App\Models\Category;
use App\Models\FavoriteProduct;
use App\Models\Product;
use http\Exception\RuntimeException;

class ProductRepository
{

    /**
     * Get product by product name
     * @param string|null $productName
     * @return \Illuminate\Support\Collection
     */
    public function getProductByName($productName)
    {
        if($productName === null){
            return collect([]);
        }

        return Product::where('name', $productName)->with('image')->first();
    }


    /**
     * Get product by id
     * @param integer|null $productId
     */
    public function getProductById($productId)
    {
        if($productId === null){
            return collect([]);
        }

        return Product::with('image')->find($productId);
    }

    /**
     * Get all products
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProducts()
    {
        return Product::all();
    }

    /**
     * Get all products by category name
     * @param string|null $categoryName
     * @return \Illuminate\Support\Collection
     */
    public function getAllProductsByCategoryName($categoryName)
    {
        $categoryId = Category::firstWhere('name', $categoryName)?->id;
        if ($categoryId === null) {
            throw new \RuntimeException('Category not found');
        }
        $subcategories = Category::where('parent_id', $categoryId)->pluck('id');

        if ($subcategories->isEmpty()){
            return collect([]);
        }

        return Product::whereIn('subcategory_id', $subcategories)->with('image')->with('attribute')->paginate(9);
    }


    /**
     * Get all products by subcategory name with paginate
     * @param string|null $subcategoryName
     * @return mixed
     */
    public function getAllProductBySubcategoryNameWithPaginate($subcategoryName)
    {
        $subcategoryId = Category::firstWhere('name', $subcategoryName)?->id;

        if($subcategoryId === null){
            throw new \RuntimeException('Subcategory not found');
        }

        return Product::where('subcategory_id', $subcategoryId)->with('image')->with('attribute')->paginate(9);
    }

    /**
     * Get all products by subcategory id with paginate
     * @param integer|null $subcategoryId
     * @return \Illuminate\Support\Collection
     */
    public function getAllProductBySubcategoryIdWithPaginate($subcategoryId)
    {
        if($subcategoryId === null){
            return collect([]);
        }

        return Product::where('subcategory_id', $subcategoryId)->with('image')->paginate(10);
    }

    /**
     * Search product by name
     * @param string|null $search
     * @return mixed
     */
    public function searchProduct($search)
    {
        return Product::where('name', 'like', '%' . $search . '%')->with('image')->get();
    }

    /**
     * Search product by subcategory id
     * @param string|null $search
     * @param integer|null $subcategoryId
     * @return mixed
     */
    public function searchProductBySubcategory($search, $subcategoryId)
    {
        if($subcategoryId === null){
            throw new RuntimeException('Subcategory not found');
        }

        return Product::where('name', 'like', '%' . $search . '%')->where('subcategory_id', $subcategoryId)->paginate(10);
    }

    /**
     * Delete product by product id
     * @param integer|null $productId
     * @return void
     */
    public function deleteProduct($productId)
    {
        if($productId === null){
            throw new RuntimeException('Product not found');
        }

        Product::destroy($productId);
    }

    /**
     * Store product
     * @param string $productName
     * @param string $productPrice
     * @param string $productProducer
     * @param string $productDescription
     * @param integer $subcategoryId
     * @return void
     * @throws \Exception
     */
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

    /**
     * Save product to favorites
     * @param integer|null $user_id
     * @param integer|null $product_id
     * @return bool
     */
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

    /**
     * Delete product from favorites
     * @param integer|null $favorite_id
     * @return void
     */
    public function deleteFromFavorite($favorite_id)
    {
        if($favorite_id === null){
            throw new RuntimeException('Favorites not found');
        }

        FavoriteProduct::destroy($favorite_id);
    }

    /**
     * Check if product is in favorites
     * @param integer|null $user_id
     * @param integer|null $product_id
     * @return bool
     */
    public function checkFavorite($user_id, $product_id)
    {
        $favProd = FavoriteProduct::where('user_id', $user_id)->where('product_id', $product_id);
        $result = false;

        if($favProd->exists()){
            $result = true;
        }
        return $result;
    }

    /**
     * Get number of customers who added product to favorites
     * @param integer|null $product_id
     * @return int
     */
    public function getFavoriteCount($product_id)
    {
        if($product_id === null){
            return 0;
        }

        return FavoriteProduct::where('product_id', $product_id)->count();
    }
}
