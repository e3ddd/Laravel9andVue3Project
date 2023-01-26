<?php

namespace App\Http\Controllers;


use App\Services\ProductService;
use Illuminate\Http\Request;

class CategoriesNavController extends Controller
{
    public function get(Request $request)
    {
        $productService = app(ProductService::class);
        return $productService->getPrdByCtr($request->category);
    }

    public function show()
    {
        return view("UsersProducts.bycategory");
    }
}
