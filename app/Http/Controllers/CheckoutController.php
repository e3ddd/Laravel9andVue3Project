<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use App\Services\ShoppingCartService;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function success()
    {
        $shoppingCartService = app(ShoppingCartService::class);

        $shoppingCart = ShoppingCart::where('user_id', Auth::user()->id)->get();

        foreach ($shoppingCart as $item){
            $shoppingCartService->deleteFromShoppingCart($item['product_id']);
        }

        return view('Checkout.success');
    }

    public function cancel()
    {

        return view('Checkout.cancel');
    }

    public function checkout()
    {
        $shoppingCartService = app(ShoppingCartService::class);
        return $shoppingCartService->checkout();
    }
}
