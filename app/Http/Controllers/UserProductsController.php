<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class UserProductsController extends Controller
{
    public function index()
    {
        return view('ProductList/layout');
    }

    public function show(Request $request)
    {
        $productService = app(ProductService::class);

        return $productService->allUsrProd($request->id)->toArray();
    }

    public function edit(EditProductRequest $request)
    {
        $productService = app(ProductService::class);

        return $productService->update(
            $request->id,
            $request->name,
            $request->price,
            $request->des
        );
    }

    public function destroy(Request $request)
    {
        $productService = app(ProductService::class);

        return $productService->destroy($request->id);
    }
}
