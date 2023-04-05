<?php

namespace App\Http\Controllers;


use App\Http\StripePaymentClass;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use App\Services\AdminPanel\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Events\WebhookReceived;
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
        dump(session()->all());

//        $YOUR_DOMAIN = 'http://127.0.0.1:8000';
////        Stripe::setApiKey(env('STRIPE_SECRET'));
//
//
//       $stripe = new StripeClient(env('STRIPE_SECRET'));
//
//      $checkout = $stripe->checkout->sessions->create([
//           'line_items' => [
//               [
//                   'price_data' => [
//                       'currency' => 'uah',
//                       'product_data' => [
//                           'name' => 'Test_product_1',
//                       ],
//                       'unit_amount' => 1000
//                   ],
//                   'quantity' => 1
//               ],
//               [
//                   'price_data' => [
//                       'currency' => 'uah',
//                       'product_data' => [
//                           'name' => 'Test_product_2',
//
//                       ],
//                       'unit_amount' => 2000
//                   ],
//                   'quantity' => 1
//               ],
//           ],
//           'mode' => 'payment',
//           'success_url' =>  $YOUR_DOMAIN . '/home',
//           'cancel_url' =>   $YOUR_DOMAIN,
//       ]);

//       return redirect($checkout->url);


//        dump($stripe->prices->all());
//       return redirect($checkout_session->url);
    }
}

