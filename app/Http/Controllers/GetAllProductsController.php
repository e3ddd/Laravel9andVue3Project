<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class GetAllProductsController extends Controller
{
    public function get()
    {
        return Product::with('image')->with('user')->paginate(9);
    }
}
