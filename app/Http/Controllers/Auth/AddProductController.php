<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Services\ProductService;


class AddProductController extends Controller
{
    public function index()
    {
        return view('AddProduct/layout');
    }


    public function store(AddProductRequest $request)
    {
        $productService = app(ProductService::class);

        $user_id = $productService->getUserId($request->email);

        return $productService->create($request->category, $request->subcategory, $user_id->id, $request->name, $request->price, $request->description);
    }
}
