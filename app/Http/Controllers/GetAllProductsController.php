<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

class GetAllProductsController extends Controller
{
    public function get()
    {
        $productService = app(ProductService::class);
        return $productService->all();
    }
}
