<?php

namespace App\Services\AdminPanel;

use App\Http\Enums\MagnitudeEnums\PriceEnum;
use App\Http\Factories\Convert\ConvertValueManager;
use App\Http\StripePaymentClass;
use App\Models\Order;
use App\Repositories\AdminPanel\OrderRepository;
use App\Repositories\AdminPanel\ProductRepository;
use http\Env\Response;
use http\Exception\RuntimeException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class OrderService
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Create user order
     * @param integer|null $user_id
     * @return void
     */
    public function createOrder($user_id)
    {
        $this->orderRepository->createOrder($user_id);
    }

    /**
     * Store user order products
     * @param integer|null $user_id
     * @param array $products
     * @return void
     */
    public function storeOrderProducts($user_id, $products)
    {
        $this->orderRepository->storeOrderProducts($user_id, $products);
    }

    /**
     * Update user order status
     * @param integer|null $user_id
     * @param string $status
     * @param integer|null $order_id
     * @return void
     */
    public function updateOrderStatus($user_id, $status, $order_id = null)
    {
        $this->orderRepository->updateOrderStatus($user_id, $status, $order_id);
    }

    /**
     * Get user orders
     * @param integer|null $user_id
     * @return LengthAwarePaginator
     * @throws \Exception
     */
    public function getUserOrders($user_id)
    {
        $orders = Order::where('user_id', $user_id)->with('products')->get()->toArray();

        $convertValueManager = new ConvertValueManager();
        $newOrders = [];

        foreach ($orders as $order){
            $amount = 0;
            foreach ($order['products'] as $product){
                $amount += ($product['quantity'] * $product['product_price']);
            }
            $amount = $convertValueManager->for(PriceEnum::coin, $amount)->convertTo(PriceEnum::banknote);
            $order['amount'] = $amount;
            $newOrders[] = $order;
        }

        return $this->paginate($newOrders);
    }

    /**
     * Check unpaid user orders
     * @param integer|null $user_id
     * @return bool
     */
    public function checkUnpaidOrders($user_id)
    {
       return $this->orderRepository->checkUnpaidOrders($user_id);
    }

    /**
     * Create checkout by unpaid order
     * @param integer|null $order_id
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function checkoutByExistingOrder($order_id)
    {
        \session()->put('order_id', $order_id);

        $orderProducts = $this->orderRepository->getOrderProducts($order_id)->toArray();

        $checkout = new StripePaymentClass();

        $lineItems = $checkout->createLineItems($orderProducts);

        return $checkout->startCheckoutSession($lineItems['products'], $order_id);
    }

    /**
     * Delete order
     * @param integer|null $order_id
     * @throws \Exception
     */
    public function deleteOrder($order_id)
    {
            $this->orderRepository->deleteOrderProducts($order_id);
            $this->orderRepository->deleteOrder($order_id);
    }

    /**
     * Pagination for regular array
     * @param $items
     * @param $perPage
     * @param $page
     * @param $options
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage = 7, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
