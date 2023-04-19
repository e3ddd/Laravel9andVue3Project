<?php

namespace App\Http\Controllers;


use App\Http\Enums\MagnitudeEnums\PriceEnum;
use App\Http\Factories\Convert\ConvertValueManager;
use App\Http\StripePaymentClass;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Repositories\AdminPanel\OrderRepository;
use App\Services\AdminPanel\OrderService;
use App\Services\ShoppingCartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session;
use Stripe\Price;
use Stripe\Stripe;


class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }

    public function index(Request $request)
    {
        $checkout = new StripePaymentClass();
        $shoppingCartService = app(ShoppingCartService::class);

        $shoppingCart = $shoppingCartService->getUserShoppingCart();

        return $checkout->startCheckoutSession($checkout->createLineItems($shoppingCart)['products']);
//        return $checkout->startCheckoutSession($orderProducts, 89);

    }
}

