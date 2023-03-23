<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\User;
use App\Services\AdminPanel\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }

    public function index(Request $request)
    {

//        dump(User::with('productsInShoppingCart')->find(Auth::user()->getAuthIdentifier()));
    }
}

