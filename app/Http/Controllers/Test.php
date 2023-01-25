<?php

namespace App\Http\Controllers;


use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;

class Test extends Controller
{

    public function index()
    {
        $productService = app(ProductService::class);

        return $productService->allUsrProd(2)->toArray();
    }

}
