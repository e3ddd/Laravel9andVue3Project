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

    public function all($id)
    {
        return $this->productRepository->getAllProducts($id);
    }

    public function find(int $id)
    {
        return $this->productRepository->getProduct($id);
    }

    public function create(string $name, int $price, string $description)
    {
        return $this->productRepository->createProduct($name, $price, $description);
    }

    public function update(int $id, string $name, int $price, string $description)
    {
        return $this->productRepository->updateProduct($id, $name, $price, $description);
    }

    public function destroy(int $id)
    {
        return $this->productRepository->destroyProduct($id);
    }
}

