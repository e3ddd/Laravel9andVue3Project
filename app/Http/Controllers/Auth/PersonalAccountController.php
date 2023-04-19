<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AdminPanel\OrderService;
use Illuminate\Support\Facades\Auth;

class PersonalAccountController extends Controller
{
    public function getUserOrders()
    {
        if(Auth::check()){
            $orderService = app(OrderService::class);
            return $orderService->getUserOrders(Auth::user()->id);
        }
    }

}
