<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminPanel\ProductService;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function show()
    {
        return view('AdminPanel.Products.layout');
    }

    public function showAboutProduct()
    {
        return view('AboutProduct.layout');
    }

    public function storeProduct(Request $request)
    {
        $productService = app(ProductService::class);

        return $productService->storeProduct($request->subcategoryId, $request->product);
    }

    public function storeProductImages(Request $request)
    {
        $imageService = app(ImageService::class);
        foreach ($request->images as $image){
            $imageService->saveImage($image, $imageService->storeImage($request->productId, $image));
        }
    }

    public function getProductByName(Request $request)
    {
        $productService = app(ProductService::class);
        return $productService->getProductByName($request->productName);
    }

    public function getProductById(Request $request)
    {
        $productService = app(ProductService::class);
        return $productService->getProductById($request->productId);
    }

    public function getAllProductsByCategoryName(Request $request)
    {
        $productService = app(ProductService::class);
        return $productService->getAllProductsByCategoryName($request->categoryName);
    }

    public function getAllProductBySubcategoryIdWithPaginate(Request $request)
    {
        $productService = app(ProductService::class);
        return $productService->getAllProductBySubcategoryIdWithPaginate($request->subcategoryId);
    }

    public function getAllProductBySubcategoryNameWithPaginate(Request $request)
    {
        $productService = app(ProductService::class);
        return $productService->getAllProductBySubcategoryNameWithPaginate($request->subcategoryName);
    }

    public function searchProduct(Request $request)
    {
        $productService = app(ProductService::class);
        return $productService->searchProduct($request->search);
    }
    public function searchProductBySubcategory(Request $request)
    {
        $productService = app(ProductService::class);

        return $productService->searchProductBySubcategory($request->search, $request->subcategoryId);
    }

    public function deleteProduct(Request $request)
    {
        $productService = app(ProductService::class);

        return $productService->deleteProduct($request->productId);
    }

    public function getAuthUserProductsFromShoppingCart()
    {
        $productService = app(ProductService::class);
        return $productService->getAuthUserProductsFromShoppingCart();
    }

    public function saveToFavorite(Request $request)
    {
        $productService = app(ProductService::class);
        return $productService->saveToFavorite($request->product_id);
    }

    public function checkFavorite(Request $request)
    {
        $productService = app(ProductService::class);
        return $productService->checkFavorite($request->product_id);
    }

    public function getFavoriteCount(Request $request)
    {
        $productService = app(ProductService::class);
        return $productService->getFavoriteCount($request->product_id);
    }
}
