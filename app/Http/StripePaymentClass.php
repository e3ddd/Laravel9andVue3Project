<?php

namespace App\Http;


use App\Models\Order;
use App\Repositories\AdminPanel\ProductRepository;
use App\Services\AdminPanel\OrderService;
use App\Services\ShoppingCartService;
use http\Exception\RuntimeException;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;


class StripePaymentClass
{
    private const DOMAIN = "http://127.0.0.1:8000";

    /**
     * Formation of prodcuts for stripe checkout session
     * @param array $products
     * @return array
     */
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

    /**
     * Create stripe checkout session
     * @param array $lineItems
     * @param integer|null $order_id
     * @return Session
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function createCheckoutSession($lineItems, $order_id)
    {
        if($order_id === null){
            throw new RuntimeException('Order not found');
        }

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

    /**
     * Create order
     * @param array $products
     * @return void
     */
    public function createOrder($products)
    {
        /** @var OrderService $orderService */
            $orderService = app(OrderService::class);
            $orderService->createOrder(Auth::user()->id);
            $orderService->storeOrderProducts(Auth::user()->id, $products);
    }

    /**
     * Clear shopping cart after creating order
     */
    public function clearShoppingCart()
    {
        /** @var ShoppingCartService $shoppingCartService */
        $shoppingCartService = app(ShoppingCartService::class);
        $shoppingCartService->clearShoppingCart();
    }

    /**
     * Start stripe checkout session
     * @param array $products
     * @param integer|null $order_id
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function startCheckoutSession($products, $order_id)
    {

        try {
            $session = $this->createCheckoutSession($products, $order_id);
        }catch (\RuntimeException $e){
            throw new $e;
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
