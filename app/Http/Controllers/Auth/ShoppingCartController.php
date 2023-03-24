<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ShoppingCartService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShoppingCartController extends Controller
{
    public function show()
    {
        return view('ShoppingCart.layout');
    }

    public function storeToShoppingCart(Request $request)
    {
        $shoppingCartService = app(ShoppingCartService::class);
        $shoppingCartService->storeToShoppingCart($request->productId);
    }

    public function getNumberOfProductsInShoppingCart()
    {
        if(Auth::check()){
            $shoppingCartService = app(ShoppingCartService::class);
            return $shoppingCartService->getNumberOfProductsInShoppingCart(Auth::user()->getAuthIdentifier());
        }else{
            if(session()->has('productIds')){
                return count(session()->get('productIds'));
            }
        }
    }

    public function deleteFromShoppingCart(Request $request)
    {
        $shoppingCartService = app(ShoppingCartService::class);
        return $shoppingCartService->deleteFromShoppingCart($request->shoppingCartProductId);
    }

    public function checkout()
    {
        return 1;
    }
}
