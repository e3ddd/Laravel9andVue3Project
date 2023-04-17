<?php

namespace App\Http\Middleware;

use App\Services\AdminPanel\OrderService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveOrderProducts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(session()->has('order_products')){
                $orderService = app(OrderService::class);

                $orderService->storeOrderProducts(Auth::user()->id, session()->pull('order_products')['products']);

            }
        }

        return $next($request);
    }
}
