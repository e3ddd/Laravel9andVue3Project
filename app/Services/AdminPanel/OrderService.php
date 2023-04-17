<?php

namespace App\Services\AdminPanel;

use App\Http\Enums\MagnitudeEnums\PriceEnum;
use App\Http\Factories\Convert\ConvertValueManager;
use App\Models\Order;
use App\Repositories\AdminPanel\OrderRepository;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder($user_id)
    {
        $this->orderRepository->createOrder($user_id);
    }

    public function storeOrderProducts($user_id, $products)
    {
        $this->orderRepository->storeOrderProducts($user_id, $products);
    }

    public function updateOrderStatus($user_id)
    {
        $this->orderRepository->updateOrderStatus($user_id);
    }

    public function getUserOrders($user_id)
    {
        $orders = Order::where('user_id', Auth::user()->id)->with('products')->get()->toArray();
        $convertValueManager = new ConvertValueManager();
        $newOrders =[];

        foreach ($orders as $order){
            $amount = 0;
            foreach ($order['products'] as $product){
                $amount += ($product['quantity'] * $product['product_price']);
            }
            $amount = $convertValueManager->for(PriceEnum::coin, $amount)->convertTo(PriceEnum::banknote);

            $order['amount'] = $amount;

            $newOrders[] = $order;
        }

        return $newOrders;
    }
}
