<?php

namespace App\Services\AdminPanel;

use App\Http\Enums\MagnitudeEnums\CapacityEnum;
use App\Http\Enums\MagnitudeEnums\DimensionsEnum;
use App\Http\Enums\MagnitudeEnums\MemoryValuesEnum;
use App\Http\Enums\MagnitudeEnums\WeightEnum;
use App\Http\Factories\Convert\ConvertValueManager;
use App\Http\Enums\MagnitudeEnums\PriceEnum;
use App\Repositories\AdminPanel\CategoriesAndAttributesRepository;
use App\Repositories\AdminPanel\ProductRepository;

class ProductService
{
    private ProductRepository $productRepository;
    private CategoriesAndAttributesRepository $categoriesAndAttributesRepository;

    public function __construct(ProductRepository $productRepository, CategoriesAndAttributesRepository $categoriesAndAttributesRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoriesAndAttributesRepository = $categoriesAndAttributesRepository;
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
                $product[$key] = $convertValueManager->for(PriceEnum::coin, $item)->convertTo(PriceEnum::banknote);
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

    public function getProductBySubcategoryIdWithPaginate($subcategoryId)
    {
        return $this->productRepository->getProductBySubcategoryIdWithPaginate($subcategoryId);
    }

    public function getAllProductsByCategory($categoryName)
    {
        return $this->productRepository->getAllProductsByCategory($categoryName);
    }

    public function deleteProduct($productId)
    {
        $this->productRepository->deleteProduct($productId);
    }

    public function storeAttributesValues($prodId, $subcategoryId, $attrValues)
    {
        $validValues = [];
        $convertValueManager = new ConvertValueManager();
        foreach ($attrValues as $attrValue){
            if($attrValue['type'] != 'string'){
                    $validValues[$attrValue['name']] = $convertValueManager->validate($attrValue, $attrValue['type']);
            }else{
                $validValues[$attrValue['name']] = $attrValue['value'];
            }
        }
        $this->productRepository->storeAttributesValues($validValues, $prodId);

        $this->productRepository->updateAttrOrder($subcategoryId, $attrValues);
    }

    public function searchProduct($search)
    {
        return $this->productRepository->searchProduct($search);
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

            $this->categoriesAndAttributesRepository->createAttribute($subcategoryId, $productValues, 1);
            $this->productRepository->updateAttrOrder($subcategoryId, $productValues);


            $this->productRepository->storeProduct($product['name'], $validPrice,
                                                    $product['producer'], $product['description'],
                                                                     $subcategoryId);
    }
}
