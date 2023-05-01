<?php

namespace App\Services\AdminPanel;

use App\Http\Factories\Convert\ConvertValueManager;
use App\Http\Enums\MagnitudeEnums\PriceEnum;
use App\Repositories\AdminPanel\AttributesRepository;
use App\Repositories\AdminPanel\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Vonage\Account\Price;

class ProductService
{
    private ProductRepository $productRepository;
    private AttributesRepository $attributesRepository;

    private UserRepository $userRepository;

    public function __construct(ProductRepository $productRepository, AttributesRepository $attributesRepository, UserRepository $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->attributesRepository = $attributesRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Get product by product name
     * @param string|null $productName
     * @return array
     * @throws \Exception
     */
    public function getProductByName($productName)
    {
        $product = [];
        $convertValueManager = new ConvertValueManager();
        foreach ($this->productRepository->getProductByName($productName)->toArray() as $key => $item){
            if($key == 'price'){
                $product[$key] = sprintf("%.2f", $convertValueManager->for(PriceEnum::coin, $item)->convertTo(PriceEnum::banknote)) ;
            }else{
                $product[$key] = $item;
            }
        }

        return $product;
    }

    /**
     * Get product by product id
     * @param integer|null $productId
     * @return array
     * @throws \Exception
     */
    public function getProductById($productId)
    {
        $product = [];
        $convertValueManager = new ConvertValueManager();
        foreach ($this->productRepository->getProductById($productId)->toArray() as $key => $item){
            if($key == 'price'){
                $product[$key] = sprintf("%.2f", $convertValueManager->for(PriceEnum::coin, $item)->convertTo(PriceEnum::banknote)) ;
            }else{
                $product[$key] = $item;
            }
        }

        return $product;
    }

    /**
     * Get all product
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    /**
     * Get all products by subcategory id
     * @param integer|null $subcategoryId
     * @return \Illuminate\Support\Collection
     */
    public function getAllProductBySubcategoryIdWithPaginate($subcategoryId)
    {
        return $this->productRepository->getAllProductBySubcategoryIdWithPaginate($subcategoryId);
    }

    /**
     * Get all product by subcategory name
     * @param string|null $subcategoryName
     * @return mixed
     */
    public function getAllProductBySubcategoryNameWithPaginate($subcategoryName)
    {
        return $this->productRepository->getAllProductBySubcategoryNameWithPaginate($subcategoryName);
    }

    /**
     * Get all products by category name
     * @param string|null $categoryName
     * @return \Illuminate\Support\Collection
     */
    public function getAllProductsByCategoryName($categoryName)
    {
        return $this->productRepository->getAllProductsByCategoryName($categoryName);
    }

    /**
     * Delete product by id
     * @param integer|null $productId
     * @return void
     */
    public function deleteProduct($productId)
    {
        $this->productRepository->deleteProduct($productId);
    }

    /**
     * Search product by name
     * @param string|null $search
     * @return mixed
     */
    public function searchProduct($search)
    {
        return $this->productRepository->searchProduct($search);
    }

    /**
     * Search product by subcategory
     * @param string|null $search
     * @param integer|null $subcategoryId
     * @return mixed
     */
    public function searchProductBySubcategory($search, $subcategoryId)
    {
        return $this->productRepository->searchProductBySubcategory($search, $subcategoryId);
    }

    /**
     * Store product
     * @param integer|null $subcategoryId
     * @param array $productValues
     * @return void
     * @throws \Exception
     */
    public function storeProduct($subcategoryId, $productValues)
    {
        $convertValueManager = new ConvertValueManager();

        $product = [];
        $price = 0;
        foreach ($productValues as $value){
            if($value['name'] == 'price'){
                $price = $convertValueManager->validate($value, $value['type']);
            }
            $product[$value['name']] = $value['value'];
        }
            $validPrice = explode('.', $price)[0];

            $this->attributesRepository->createAttribute($subcategoryId, $productValues, 1);
            $this->attributesRepository->updateAttrOrder($subcategoryId, $productValues);


            $this->productRepository->storeProduct($product['name'], $validPrice,
                                                    $product['producer'], $product['description'],
                                                                     $subcategoryId);
    }

    /**
     * Get user products from shopping cart
     * @return array
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getAuthUserProductsFromShoppingCart()
    {
        $products = [];
        if(Auth::check()){
            $user = $this->userRepository->getAuthUserWithProductsInShoppingCart();
            foreach ($user->productsInShoppingCart as $product){
                $products[] = $this->getProductById($product->product_id);
            }
        }else{
            if(session()->has('products')){
                foreach (session()->get('products') as $key => $product){
                    $products[] = $this->getProductById($key);
                }
            }
        }
        return $products;
    }

    /**
     * Save product to favorites
     * @param integer|null $product_id
     * @return bool|string
     * @throws \Exception
     */
    public function saveToFavorite($product_id)
    {
        if(Auth::check()){
            try {
                return $this->productRepository->saveToFavorite(Auth::user()->id, $product_id);
            }catch (\Exception $e){
                return throw new $e;
            }
        }else{
            return '/login';
        }
    }

    /**
     * Delete product from favorites
     * @param integer|null $favorite_id
     * @return void
     * @throws \Exception
     */
    public function deleteFromFavorite($favorite_id)
    {
        if(Auth::check()){
            try {
                $this->productRepository->deleteFromFavorite($favorite_id);
            }catch (\Exception $e){
                return throw new $e;
            }
        }
    }

    /**
     * Check if product is in favorites
     * @param integer|null $product_id
     * @return bool|void
     */
    public function checkFavorite($product_id)
    {
        if(Auth::check()){
            return $this->productRepository->checkFavorite(Auth::user()->id, $product_id);
        }
    }

    /**
     * Get number of customers who added product to favorites
     * @param integer|null $product_id
     * @return int
     */
    public function getFavoriteCount($product_id)
    {
        return $this->productRepository->getFavoriteCount($product_id);
    }
}
