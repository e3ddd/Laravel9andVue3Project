<?php

namespace App\Http;

use App\Models\User;
use Laravel\Cashier\Cashier;
use Stripe\StripeClient;

class StripePaymentClass
{
    private const DOMAIN = "http://127.0.0.1:8000";

    private array $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function createCheckoutSession()
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $checkout_products = [];

        foreach ($this->products as $product){
            $checkout_products[] = [
                'price_data' => [
                    'currency' => env('CASHIER_CURRENCY'),
                    'product_data' => [
                        'name' => $product[0]['product']['name'],
                    ],
                    'unit_amount' => $product[0]['product']['price']
                ],
                'quantity' => $product[0]['quantity']
            ];
        }

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $checkout_products,
            'mode' => 'payment',
            'success_url' =>  self::DOMAIN . '/success',
            'cancel_url' =>   self::DOMAIN . '/cancel'
        ]);

        return redirect($checkout_session->url);
    }
}
