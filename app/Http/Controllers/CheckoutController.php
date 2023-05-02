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
    /**
     * Show success end-point
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function success()
    {
        return view('Checkout.success');
    }

    /**
     * Show cancel end-point
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cancel()
    {
        return view('Checkout.cancel');
    }

    /**
     * Check order status
     * @return bool|void
     */
    public function checkOrderStatus()
    {
        if(Auth::check()){
            if(\session()->has('order_id')){
                $order_status = Order::find(\session()->pull('order_id'))->status;

                if($order_status == 'completed'){
                    if(\session()->has('paid_order')){
                        \session()->forget('paid_order');
                    }

                    return true;
                }
            }else{
                $lastOrder = Order::where('user_id', Auth::user()->id)->last();



                if($lastOrder->status == 'completed'){
                    return true;
                }
            }
        }
    }

    /**
     * Delete order by order id
     * @param Request $request
     * @return void
     */
    public function deleteOrder(Request $request)
    {
        /** @var OrderService $orderService */
        $orderService = app(OrderService::class);
        $orderService->deleteOrder($request->order_id);
    }

    /**
     * Create Stripe checkout session by existing order
     * @param Request $request
     * @return mixed
     */
    public function checkoutByExistingOrder(Request $request)
    {
        /** @var OrderService $orderService */
        $orderService = app(OrderService::class);
        return $orderService->checkoutByExistingOrder($request->order_id);
    }

    /**
     * Create Stripe checkout session
     * @return mixed
     */
    public function checkout()
    {
        /** @var ShoppingCartService $shoppingCartService */
        $shoppingCartService = app(ShoppingCartService::class);
        return $shoppingCartService->checkout();
    }
}
