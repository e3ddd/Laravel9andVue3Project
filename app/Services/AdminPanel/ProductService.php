<?php

namespace App\Services\AdminPanel;

use App\Http\Validate;
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

    public function getAttributes($subcategory)
    {
       return $this->productRepository->getAttributes($subcategory);
    }

    public function getProductByName($productName)
    {
        return $this->productRepository->getProductByName($productName);
    }

    public function getProductById($productId)
    {
        return $this->productRepository->getProductById($productId);
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    public function getProductBySubcategory($subcategoryId)
    {
        return $this->productRepository->getProductBySubcategory($subcategoryId);
    }

    public function storeAttributesValues($prodId, $subcategoryId, $attrValues)
    {
        $validate = new Validate();
        $validValues = [];

        foreach ($attrValues as $attrValue){
            if($attrValue['type'] != 'string'){
                $validValues[$attrValue['name']] = $validate->validate($attrValue, $attrValue['type']);
            }else{
                $validValues[$attrValue['name']] = $attrValue['value'];
            }
        }
        $this->productRepository->storeAttributesValues($validValues, $prodId);

        $this->productRepository->updateAttrOrder($subcategoryId, $attrValues);
    }

    public function storeProduct($subcategoryId, $productValues)
    {
        $validate = new Validate();
        $product = [];
        $price = 0;
        foreach ($productValues as $value){
            if($value['name'] == 'price'){
                $price = $validate->validate($value, $value['type']);
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
