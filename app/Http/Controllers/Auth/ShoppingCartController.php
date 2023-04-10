<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ShoppingCartService;
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
            return $shoppingCartService->getNumberOfProductsInShoppingCart(Auth::user()->id);
        }else{
            if(session()->has('products')){
                return count(session()->get('products'));
            }
        }
    }

    public function clearShoppingCart()
    {
        $shoppingCartService = app(ShoppingCartService::class);
        $shoppingCartService->clearShoppingCart();
    }

    public function deleteFromShoppingCart(Request $request)
    {
        $shoppingCartService = app(ShoppingCartService::class);
        return $shoppingCartService->deleteFromShoppingCart($request->shoppingCartProductId);
    }

    public function updateProductQuantity(Request $request)
    {
        $shoppingCartService = app(ShoppingCartService::class);
        return $shoppingCartService->updateProductQuantity($request->productId, $request->quantity);
    }

    public function getUserShoppingCart()
    {
        $shoppingCartService = app(ShoppingCartService::class);
        return $shoppingCartService->getUserShoppingCart();
    }
}
