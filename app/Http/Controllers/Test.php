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
        Stripe::setApiKey(env('STRIPE_SECRET'));


//        $shoppingCartService = app(ShoppingCartService::class);
//        $user_id = Auth::user()->id;
//        $shoppingCart = ShoppingCart::where('user_id', $user_id)->get();
//        try {
//            foreach ($shoppingCart as $item){
//                $shoppingCartService->deleteFromShoppingCart($item['product_id']);
//            }
//        }catch (\Exception $e){
//            return response($e, 500);
//        }
    }
}

