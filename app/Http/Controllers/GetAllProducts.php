<?php

namespace App\Http\Controllers;

use App\Models\ProductImages;
use App\Models\Products;
use Illuminate\Http\Request;

class GetAllProducts extends Controller
{
    public function get(Request $request,Products $products) {
        return $products->paginate(9);
    }
}
