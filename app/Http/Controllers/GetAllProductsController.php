<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class GetAllProductsController extends Controller
{
    public function get(Product $product)
    {
        return $product::with('image')->paginate(9);
    }
}
