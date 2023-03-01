<?php

namespace App\Services\AdminPanel;

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
        foreach ($attrValues as $value){
            if($this->productRepository->storeAttributesValues($value['name'], $value['value'], $prodId)){
                $this->productRepository->updateAttrOrder($subcategoryId, $value['name'], $value['order']);
            }
        }
    }

    public function storeProduct($subcategoryId, $productValues)
    {

        $storeProduct = [];

        foreach ($productValues as $key => $value){
            if(empty($value['value'])){
                throw new \Exception($value['name'] . ' field required !');
            }else{
                $storeProduct[$value['name']] = $value['value'];
                $this->categoriesAndAttributesRepository->createAttribute($subcategoryId, $value['name'],
                                                                          gettype($value['value']), 1);

                $this->productRepository->updateAttrOrder($subcategoryId, $value['name'], $value['order']);
            }
        }
        $this->productRepository->storeProduct($storeProduct['name'], $storeProduct['price'],
                                               $storeProduct['producer'], $storeProduct['description'], $subcategoryId);

    }
}
