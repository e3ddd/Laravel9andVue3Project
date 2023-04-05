<?php

namespace App\Http\Controllers;

use App\Services\ShoppingCartService;

class CheckoutController extends Controller
{
    public function success()
    {
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
