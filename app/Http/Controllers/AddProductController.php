<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Models\Product;
use App\Models\User;
use App\Repositories\ProductRepository;
use App\Services\ProductService;


class AddProductController extends Controller
{
    public function index()
    {
        return view('AddProduct/layout');
    }


    public function store(AddProductRequest $request)
    {
        $productService = new ProductService(app(ProductRepository::class));

        $user_id = User::where('email', $request->email)->first('id');

        return $productService->create($user_id->id, $request->name, $request->price, $request->description);
    }
}
