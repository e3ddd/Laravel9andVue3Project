<?php

namespace App\Http;

use App\Models\Order;
use App\Repositories\AdminPanel\ProductRepository;
use App\Services\AdminPanel\OrderService;
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

        try {
            $shoppingCartService->clearShoppingCart();
        }catch (\Exception $e){
            throw new $e;
        }

        return $products;
    }

    public function createOrder($session_id)
    {
        $orderService = app(OrderService::class);
        $orderService->createOrder($session_id);
    }

    public function storeOrderProducts($session_id, $products)
    {
        $orderService = app(OrderService::class);
        $orderService->storeOrderProducts($session_id, $products);
    }


    public function createCheckoutSession()
    {
        $products = $this->createCharge();
        Stripe::setApiKey(env("STRIPE_SECRET"));
        try {
            $session = Session::create([
                'line_items' => [
                    $products
                ],
                'mode' => 'payment',
                'success_url' => 'http://127.0.0.1:8000/success',
                'cancel_url' => 'http://127.0.0.1:8000/cancel',
            ]);

            $this->createOrder($session->id);
            $this->storeOrderProducts($session->id, $products);

            session()->put('session_id', $session->id);

        }catch (\Exception $e){
            throw new $e;
        }


        return redirect($session->url);
    }
}
