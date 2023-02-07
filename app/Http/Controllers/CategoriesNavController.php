<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Subcategory;
use App\Services\ProductService;
use Illuminate\Http\Request;

class CategoriesNavController extends Controller
{
    public function get(Request $request)
    {
        $productService = app(ProductService::class);

        if(isset($request->subcategory)){
            return $productService->getPrdBySubCtr($request->subcategory);
        }else{
            return $productService->getPrdByCtr($request->category);
        }
    }

    public function showByCategory()
    {
        return view("UsersProducts.bycategory");
    }

    public function showBySubcategory()
    {
        return view('UsersProducts.bysubcategory');
    }
}
