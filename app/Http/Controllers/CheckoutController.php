<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShoppingCart;
use App\Services\ShoppingCartService;
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

            if($lastOrder['status'] == 'paid'){
                return 'paid';
            }
        }


    }

    public function deleteOrder()
    {
        if(session()->has('session_id')){
            $orders = Order::where('session_id', session()->pull('session_id'))->get();
            foreach ($orders as $order){
                Order::destroy($order['id']);
            }
        }
    }

    public function checkout()
    {
        $shoppingCartService = app(ShoppingCartService::class);
        return $shoppingCartService->checkout();
    }
}
