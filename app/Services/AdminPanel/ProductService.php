<?php

namespace App\Services\AdminPanel;

use App\Http\Factories\Convert\ConvertValueManager;
use App\Http\Enums\MagnitudeEnums\PriceEnum;
use App\Repositories\AdminPanel\AttributesRepository;
use App\Repositories\AdminPanel\ProductRepository;

class ProductService
{
    private ProductRepository $productRepository;
    private AttributesRepository $attributesRepository;

    public function __construct(ProductRepository $productRepository, AttributesRepository $attributesRepository)
    {
        $this->productRepository = $productRepository;
        $this->attributesRepository = $attributesRepository;
    }


    public function getProductByName($productName)
    {
        return $this->productRepository->getProductByName($productName);
    }

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

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    public function getAllProductBySubcategoryIdWithPaginate($subcategoryId)
    {
        return $this->productRepository->getAllProductBySubcategoryIdWithPaginate($subcategoryId);
    }

    public function getAllProductBySubcategoryNameWithPaginate($subcategoryName)
    {
        return $this->productRepository->getAllProductBySubcategoryNameWithPaginate($subcategoryName);
    }

    public function getAllProductsByCategoryName($categoryName)
    {
        return $this->productRepository->getAllProductsByCategoryName($categoryName);
    }

    public function deleteProduct($productId)
    {
        $this->productRepository->deleteProduct($productId);
    }

    public function searchProduct($search)
    {
        return $this->productRepository->searchProduct($search);
    }

    public function searchProductBySubcategory($search, $subcategoryId)
    {
        return $this->productRepository->searchProductBySubcategory($search, $subcategoryId);
    }

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
}
