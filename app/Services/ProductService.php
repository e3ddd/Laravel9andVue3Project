<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function allUsrProd($id)
    {
        return $this->productRepository->getAllUserProducts($id);
    }

    public function all()
    {
        return $this->productRepository->getAllProducts();
    }

    public function find(int $id)
    {
        return $this->productRepository->getProduct($id);
    }

    public function create($userId, string $name, $price, string $description)
    {
        return $this->productRepository->createProduct($userId, $name, $price, $description);
    }

    public function update(int $productId, string $name, $price, string $description)
    {
        return $this->productRepository->updateProduct($productId, $name, $price, $description);
    }

    public function destroy(int $id)
    {
        return $this->productRepository->destroyProduct($id);
    }
}

