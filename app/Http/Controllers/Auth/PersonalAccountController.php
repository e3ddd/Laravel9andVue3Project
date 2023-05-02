<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AdminPanel\OrderService;
use Illuminate\Support\Facades\Auth;

class PersonalAccountController extends Controller
{
    /**
     * Get auth user orders
     * @return void
     */
    public function getUserOrders()
    {
        if(Auth::check()){
            /** @var OrderService $orderService */
            $orderService = app(OrderService::class);
            return $orderService->getUserOrders(Auth::user()->id);
        }
    }

}
