<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PersonalAccountController extends Controller
{
    public function getUserOrders()
    {
        return Order::where('user_id', Auth::user()->id)->get();
    }
}
