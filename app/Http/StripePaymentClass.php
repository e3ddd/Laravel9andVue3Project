<?php

namespace App\Http;


use App\Repositories\AdminPanel\ProductRepository;
use App\Services\AdminPanel\OrderService;
use App\Services\ShoppingCartService;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;


class StripePaymentClass
{
    private const DOMAIN = "http://127.0.0.1:8000";

    public function createLineItems($products)
    {
        $productRepository = new ProductRepository();

        $responseProducts = [];
        $amount = 0;
        foreach ($products as $item){
                if(array_key_exists('product_name', $item)){
                    $product = $productRepository->getProductByName($item['product_name']);
                }else {
                    $product = $productRepository->getProductById($item['product_id']);
                }

            $responseProducts['products'][] = [
                'price_data' => [
                    'currency' => 'uah',
                    'product_data' => [
                        'name' => $product['name'],
                    ],
                    'unit_amount' => $product['price'],
                ],
                'quantity' => $item['quantity'],
            ];
            $amount += ($product->price * $item['quantity']);
        }
        $responseProducts['amount'] = $amount;

        return $responseProducts;
    }

    public function createCheckoutSession($lineItems, $order_id = null)
    {
        Stripe::setApiKey(env("STRIPE_SECRET"));
        $session = Session::create([
            'line_items' => [
                $lineItems
            ],
            'metadata' => [
                'customer_id' => Auth::user()->id,
                'order_id' => $order_id
            ],
            'mode' => 'payment',
            'payment_intent_data' => [
                'metadata' => [
                    'customer_id' => Auth::user()->id,
                    'order_id' => $order_id
                ]
            ],
            'success_url' => self::DOMAIN . '/success',
            'cancel_url' =>  self::DOMAIN . '/cancel',
        ]);

        return $session;
    }

    public function createOrder($products)
    {
        try {
            $orderService = app(OrderService::class);
            $orderService->createOrder(Auth::user()->id);
            $orderService->storeOrderProducts(Auth::user()->id, $products);

        }catch (\Exception $e){
            return response("Can't create order !", 500);
        }
    }

    public function clearShoppingCart()
    {
        $shoppingCartService = app(ShoppingCartService::class);

        try {
            $shoppingCartService->clearShoppingCart();
        }catch (\Exception $e){
            return response("Can't clear shopping cart !", 500);
        }
    }


    public function startCheckoutSession($products, $order_id = null)
    {
        try {
            $session = $this->createCheckoutSession($products);
        }catch (\Exception $e){
            return response("Can't create checkout session !", 500);
        }

        if($order_id === null){
            $this->createOrder($products);
            $this->clearShoppingCart();
            return redirect($session->url);
        }else{
            return $session->url;
        }
    }
}
