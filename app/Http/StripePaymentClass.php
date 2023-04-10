<?php

namespace App\Http;

use App\Models\Order;
use App\Repositories\AdminPanel\ProductRepository;
use App\Services\ShoppingCartService;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;


class StripePaymentClass
{
    private const DOMAIN = "http://127.0.0.1:8000";

    public function createCharge()
    {
        $productRepository = new ProductRepository();
        $shoppingCartService = app(ShoppingCartService::class);
        $shoppingCart = $shoppingCartService->getUserShoppingCart();
        $products = [];

        foreach ($shoppingCart as $item){
            $product = $productRepository->getProductById($item['product_id']);
            $products[] = [
                'price_data' => [
                    'currency' => 'uah',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price,
                ],
                'quantity' => $item['quantity'],
            ];
        }
        return $products;
    }

    public function createOrder($session_id, $products)
    {
        $user_id = Auth::user()->id;
        if(!Order::where('session_id', $session_id)->exists()){
            foreach ($products as $product){
                    Order::create([
                        'session_id' => $session_id,
                        'status' => 'unpaid',
                        'product_name' => $product['price_data']['product_data']['name'],
                        'product_quantity' => $product['quantity'],
                        'product_price' => $product['price_data']['unit_amount'],
                        'user_id' => $user_id,
                    ]);
            }
        }
    }

    public function createCheckoutSession()
    {
        $products = $this->createCharge();
        Stripe::setApiKey(env("STRIPE_SECRET"));
        $session = Session::create([
            'line_items' => [
                $products
            ],
            'mode' => 'payment',
            'success_url' => 'http://127.0.0.1:8000/success',
            'cancel_url' => 'http://127.0.0.1:8000/cancel',
        ]);

        session()->put('session_id', $session->id);

        $this->createOrder($session->id, $products);

        return redirect($session->url);
    }
}
