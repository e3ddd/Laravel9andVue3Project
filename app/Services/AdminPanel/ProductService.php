<?php

namespace App\Services\AdminPanel;

use App\Repositories\AdminPanel\ProductRepository;

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAttributes($subcategory)
    {
       return $this->productRepository->getAttributes($subcategory);
    }
}
