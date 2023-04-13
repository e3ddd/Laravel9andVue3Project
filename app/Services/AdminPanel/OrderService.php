<?php

namespace App\Services\AdminPanel;

use App\Repositories\AdminPanel\OrderRepository;

class OrderService
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder($session_id)
    {
        $this->orderRepository->createOrder($session_id);
    }

    public function storeOrderProducts($session_id, $products)
    {
        $this->orderRepository->storeOrderProducts($session_id, $products);

    }

    public function updatePayStatus($session_id)
    {
        $this->orderRepository->updatePayStatus($session_id);
    }
}
