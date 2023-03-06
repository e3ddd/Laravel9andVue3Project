<?php

namespace App\Services\AdminPanel;

use App\Http\CreateProductClass;
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

    }

    public function storeProduct($subcategoryId, $productValues)
    {
        $validate = new CreateProductClass();

            $validProduct = $validate->validate($productValues, PriceEnum::tryFrom('banknote'), PriceEnum::coin);

            $validPrice = explode('.', $validProduct['price'])[0];

            $this->categoriesAndAttributesRepository->createAttribute($subcategoryId, $productValues, 1);
            $this->productRepository->updateAttrOrder($subcategoryId, $productValues);


            $this->productRepository->storeProduct($validProduct['name'], $validPrice,
                                              $validProduct['producer'], $validProduct['description'],
                                                                     $subcategoryId);
    }
}
