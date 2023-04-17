<?php

namespace App\Http;


use App\Models\User;
use App\Repositories\AdminPanel\ProductRepository;
use App\Services\ShoppingCartService;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Stripe\Stripe;


class StripePaymentClass
{
    private const DOMAIN = "http://127.0.0.1:8000";

    public function createLineItems()
    {
        $productRepository = new ProductRepository();
        $shoppingCartService = app(ShoppingCartService::class);

        $shoppingCart = $shoppingCartService->getUserShoppingCart();

        $products = [];
        $amount = 0;
        foreach ($shoppingCart as $item){
            $product = $productRepository->getProductById($item['product_id']);
            $products['products'][] = [
                'price_data' => [
                    'currency' => 'uah',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price,
                ],
                'quantity' => $item['quantity'],
            ];
            $amount += ($product->price * $item['quantity']);
        }
        $products['amount'] = $amount;

        return $products;
    }


    public function createCheckoutSession()
    {
        $shoppingCartService = app(ShoppingCartService::class);

        $products = $this->createLineItems();

        Stripe::setApiKey(env("STRIPE_SECRET"));

            $session = Session::create([
                'line_items' => [
                    $products['products']
                ],
                'metadata' => [
                    'customer_id' => Auth::user()->id
                ],
                'mode' => 'payment',
                'payment_intent_data' => [
                    'metadata' => [
                        'customer_id' => Auth::user()->id,
                    ]
                ],
                'success_url' => self::DOMAIN . '/success',
                'cancel_url' =>  self::DOMAIN . '/cancel',
            ]);

        try {
            $shoppingCartService->clearShoppingCart();
        }catch (\Exception $e){
            return response($e, 500);
        }

        \session()->put('order_products', $products);

        return redirect($session->url);
    }
}
