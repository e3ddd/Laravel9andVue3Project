<?php

namespace App\Http\Controllers;

use App\Http\StripePaymentClass;
use App\Models\Order;
use App\Models\ShoppingCart;
use App\Services\AdminPanel\OrderService;
use App\Services\ShoppingCartService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;

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

    public function checkOrderStatus()
    {
        if(Auth::check()){
            $order = Order::where('user_id', Auth::user()->id)->get('status')->toArray();

            $lastOrder = array_pop($order);

            if($lastOrder['status'] == 'completed'){
                return true;
            }
        }


    }

    public function deleteOrder(Request $request)
    {
        $orderService = app(OrderService::class);
        $orderService->deleteOrder($request->order_id);
    }

    public function checkoutByExistingOrder(Request $request)
    {
        $orderService = app(OrderService::class);
        return $orderService->checkoutByExistingOrder($request->order_id);
    }

    public function checkout()
    {
        $shoppingCartService = app(ShoppingCartService::class);
        return $shoppingCartService->checkout();
    }
}
