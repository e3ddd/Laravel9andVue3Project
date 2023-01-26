<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\ProductRepository;

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function allUsrProd($userId)
    {
        return $this->productRepository->getAllUserProducts($userId);
    }

    public function getPrdByCtr($name)
    {
        return $this->productRepository->getProductsByCategory($name);
    }

    public function all()
    {
        return $this->productRepository->getAllProducts();
    }

    public function find($productId)
    {
        return $this->productRepository->getProduct($productId);
    }

    public function create($category, $userId, $name, $price, $description)
    {
        return $this->productRepository->createProduct($category, $userId, $name, $price, $description);
    }

    public function update($productId, $name, $price, $description)
    {
        return $this->productRepository->updateProduct($productId, $name, $price, $description);
    }

    public function destroy($productId)
    {
        return $this->productRepository->destroyProduct($productId);
    }

    public function getUserId($userEmail)
    {
        return $this->productRepository->getUserIdByEmail($userEmail);
    }
}

