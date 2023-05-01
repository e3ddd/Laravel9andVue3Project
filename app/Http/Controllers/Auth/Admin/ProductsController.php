<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateCategoryName;
use App\Http\Requests\ValidateFavoriteId;
use App\Http\Requests\ValidateProductId;
use App\Http\Requests\ValidateProductName;
use App\Http\Requests\ValidateSearchField;
use App\Http\Requests\ValidateStoreProduct;
use App\Http\Requests\ValidateSubcategoryId;
use App\Http\Requests\ValidateSubcateryNameRequest;
use App\Services\AdminPanel\ProductService;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Show products list
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {
        return view('AdminPanel.Products.layout');
    }

    /**
     * Show about product page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showAboutProduct()
    {
        return view('AboutProduct.layout');
    }


    /**
     * Store product
     * @param ValidateStoreProduct $request
     * @return mixed
     */
    public function storeProduct(ValidateStoreProduct $request)
    {
        /** @var ProductService $productService */
        $productService = app(ProductService::class);
        $productService->storeProduct($request->subcategoryId, $request->product);
    }

    /**
     * Store product images
     * @param Request $request
     * @return void
     */
    public function storeProductImages(Request $request)
    {
        /** @var ImageService $imageService */
        $imageService = app(ImageService::class);
        foreach ($request->images as $image){
            $imageService->saveImage($image, $imageService->storeImage($request->productId, $image));
        }
    }

    /**
     * Get product by name
     * @param ValidateProductName $request
     * @return mixed
     */
    public function getProductByName(ValidateProductName $request)
    {
        /** @var ProductService $productService */
        $productService = app(ProductService::class);
        return $productService->getProductByName($request->productName);
    }

    /**
     * Get product by id
     * @param ValidateProductId $request
     * @return mixed
     */
    public function getProductById(ValidateProductId $request)
    {
        /** @var ProductService $productService */
        $productService = app(ProductService::class);
        return $productService->getProductById($request->productId);
    }

    /**
     * Get all product by category name
     * @param ValidateCategoryName $request
     * @return \Illuminate\Support\Collection
     */
    public function getAllProductsByCategoryName(ValidateCategoryName $request)
    {
        /** @var ProductService $productService */
        $productService = app(ProductService::class);
        return $productService->getAllProductsByCategoryName($request->categoryName);
    }

    /**
     * Get all products by subcategory id
     * @param ValidateSubcategoryId $request
     * @return mixed
     */
    public function getAllProductBySubcategoryIdWithPaginate(ValidateSubcategoryId $request)
    {
        /** @var ProductService $productService */
        $productService = app(ProductService::class);
        return $productService->getAllProductBySubcategoryIdWithPaginate($request->subcategoryId);
    }

    /**
     * Get all products by subcategory name
     * @param ValidateCategoryName $request
     * @return mixed
     */
    public function getAllProductBySubcategoryNameWithPaginate(ValidateSubcateryNameRequest $request)
    {
        /** @var ProductService $productService */
        $productService = app(ProductService::class);
        return $productService->getAllProductBySubcategoryNameWithPaginate($request->subcategoryName);
    }

    /**
     * Search product by name
     * @param ValidateSearchField $request
     * @return mixed
     */
    public function searchProduct(ValidateSearchField $request)
    {
        /** @var ProductService $productService */
        $productService = app(ProductService::class);
        return $productService->searchProduct($request->search);
    }

    /**
     * Search product by subcategory id
     * @param Request $request
     * @return mixed
     */
    public function searchProductBySubcategory(Request $request)
    {
        $validate = $request->validate([
            'search' => 'nullable|string',
            'subcategoryId' => 'required|integer',
        ]);

        /** @var ProductService $productService */
        $productService = app(ProductService::class);
        return $productService->searchProductBySubcategory($request->search, $request->subcategoryId);
    }

    /**
     * Delete product by id
     * @param ValidateProductId $request
     * @return mixed
     */
    public function deleteProduct(ValidateProductId $request)
    {
        /** @var ProductService $productService */
        $productService = app(ProductService::class);
        $productService->deleteProduct($request->productId);
    }

    /**
     * Get auth user shopping cart
     * @return mixed
     */
    public function getAuthUserProductsFromShoppingCart()
    {
        /** @var ProductService $productService */
        $productService = app(ProductService::class);
        return $productService->getAuthUserProductsFromShoppingCart();
    }

    /**
     * Save prodcut to favorites
     * @param ValidateProductId $request
     * @return mixed
     */
    public function saveToFavorite(ValidateProductId $request)
    {
        /** @var ProductService $productService */
        $productService = app(ProductService::class);
        return $productService->saveToFavorite($request->productId);
    }

    /**
     * Delete from favorites
     * @param ValidateFavoriteId $request
     * @return void
     */
    public function deleteFromFavorite(ValidateFavoriteId $request)
    {
        /** @var ProductService $productService */
        $productService = app(ProductService::class);
        $productService->deleteFromFavorite($request->favoriteId);
    }

    /**
     * Check if product is in favorites
     * @param integer|null $user_id
     * @param integer|null $product_id
     * @return bool
     */
    public function checkFavorite(ValidateProductId $request)
    {
        /** @var ProductService $productService */
        $productService = app(ProductService::class);
        return $productService->checkFavorite($request->productId);
    }

    /**
     * Get number of customers who added product to favorites
     * @param integer|null $product_id
     * @return int
     */
    public function getFavoriteCount(ValidateProductId $request)
    {
        /** @var ProductService $productService */
        $productService = app(ProductService::class);
        return $productService->getFavoriteCount($request->productId);
    }
}
