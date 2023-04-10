<?php

namespace App\Http\Controllers;


use App\Http\StripePaymentClass;
use App\Listeners\StripeEventListener;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use App\Repositories\AdminPanel\ProductRepository;
use App\Services\AdminPanel\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Events\WebhookReceived;
use PHPUnit\Exception;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Webhook;
use function Symfony\Component\String\s;


class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }

    public function index(Request $request)
    {
//        $test = new StripePaymentClass();
//
//        foreach ($test->createCharge() as $item){
//            dump($item);
//        }
//        $test = new ProductRepository();
//        dump($test->getProductById(4));
//        $order = Order::where('session_id', "cs_test_b1czdzfpNuf1yQkgljUGTPGJ6WeLEM1oSGyXsNDHW4Ibb4x4Jj0r9p4dJf")->get();
//        foreach ($order as $item){
//            if($item['status'] === 'unpaid'){
//                Order::where('session_id', "cs_test_b1czdzfpNuf1yQkgljUGTPGJ6WeLEM1oSGyXsNDHW4Ibb4x4Jj0r9p4dJf")->where('status', 'unpaid')->update(['status' => 'paid']);
//            }
//        }
    }
}

