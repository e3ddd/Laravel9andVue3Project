<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;

class GetAllProductsController extends Controller
{
    public function get()
    {
        $productService = new ProductService(app(ProductRepository::class));
        return $productService->all();
    }
}
