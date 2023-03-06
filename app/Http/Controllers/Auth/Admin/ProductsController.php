<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
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

    public function storeProduct(Request $request)
    {
        $productService = app(ProductService::class);

        return $productService->storeProduct($request->subcategoryId, $request->product);
    }

    public function storeAttributesValues(Request $request)
    {
        $productService = app(ProductService::class);
        $productService->storeAttributesValues($request->productId, $request->subcategoryId, $request->attributesValue);
    }

    public function getProductBySubcategory(Request $request)
    {
        $productService = app(ProductService::class);

        return $productService->getProductBySubcategory($request->subcategoryId);
    }
}
