<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProductRequest;
use App\Models\Product;
use App\Models\User;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;

class UserProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('ProductList/layout');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function show(Request $request)
    {
        $productService = new ProductService(app(ProductRepository::class));

        return $productService->all($request->id)->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return EditProductRequest
     */
    public function edit(EditProductRequest $request)
    {
        $productService = new ProductService(app(ProductRepository::class));

        return $productService->update(
            $request->id,
            $request->name,
            $request->price,
            $request->des
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int
     */
    public function destroy(Request $request)
    {
        $productService = new ProductService(app(ProductRepository::class));

        return $productService->destroy($request->id);
    }
}
