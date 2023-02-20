<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminPanel\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
   public function show()
   {
       return view('AdminPanel.Products.layout');
   }

    public function getAttributes(Request $request)
    {
        $productService = app(ProductService::class);
        return $productService->getAttributes($request->subcategoryName);
    }
}
