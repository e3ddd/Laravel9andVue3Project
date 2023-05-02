<?php

namespace App\Repositories\AdminPanel;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use http\Exception\RuntimeException;

class OrderRepository
{
    /**
     * Create user order
     * @param integer|null $user_id
     * @return void
     */
    public function createOrder($user_id)
    {
        if($user_id === null){
            throw new RuntimeException('User id required');
        }

            if(User::find($user_id)) {
                Order::create([
                    'status' => 'unpaid',
                    'user_id' => $user_id
                ]);
            }else{
                throw new RuntimeException('User not found');
            }
    }

    /**
     * Store user order products
     * @param integer|null $user_id
     * @param array|null $products
     * @return void
     */
    public function storeOrderProducts($user_id, $products)
    {
        if($user_id === null){
            throw new RuntimeException('User id required');
        }

        $orders = Order::where('user_id', $user_id)->pluck('id');

        if(empty($orders)){
            throw new RuntimeException('Orders not found');
        }

        $lastOrder = $orders->last();

        foreach ($products as $product){
            OrderProduct::create([
                'product_name' => $product['price_data']['product_data']['name'],
                'quantity' => $product['quantity'],
                'product_price' => $product['price_data']['unit_amount'],
                'order_id' => $lastOrder['id']
            ]);
        }
    }

    /**
     * @param integer|null $user_id
     * @param string $status
     * @param integer|null $order_id
     * @return void
     */
    public function updateOrderStatus($user_id, $status, $order_id)
    {
        if($user_id === null){
            throw new RuntimeException('User id required');
        }

        if($order_id === null){
            $orders = Order::where('user_id', $user_id)->get('id');

            if($orders->isEmpty()){
                throw new RuntimeException('Order not found');
            }

            $lastOrder = $orders->last();
            Order::find($lastOrder['id'])->update(['status' => $status]);
        }else{
            Order::find($order_id)->update(['status' => $status]);
        }

    }

    /**
     * Delete order
     * @param integer|null $order_id
     * @return void
     * @throws \Exception
     */
    public function deleteOrder($order_id)
    {
        if($order_id === null){
            throw new RuntimeException('Order id required');
        }

        Order::destroy($order_id);
    }

    /**
     * Delete all order products
     * @param integer|null $order_id
     * @return void
     */
    public function deleteOrderProducts($order_id)
    {
        if($order_id === null){
            throw new RuntimeException('Order id required');
        }

        $products = OrderProduct::where('order_id', $order_id)->get('id');

        OrderProduct::destroy($products);
    }

    /**
     * get user orders
     * @param integer|null $user_id
     * @return mixed
     */
    public function getUserOrders($user_id)
    {
        if($user_id === null){
            throw new RuntimeException('User id required');
        }
        return Order::where('user_id', $user_id)->with('products')->get();
    }

    /**
     * Check unpaid user orders
     * @param integer|null $user_id
     * @return bool
     */
    public function checkUnpaidOrders($user_id)
    {
        if($user_id === null){
            throw new RuntimeException('User id required');
        }

        $response = false;
        if(Order::where('user_id', $user_id)->where('status', 'unpaid')->exists()){
            $response = true;
        }
        return $response;
    }

    /**
     * Get order by id
     * @param integer|null $order_id
     * @return mixed
     */
    public function getOrderById($order_id)
    {
        if($order_id === null){
            throw new RuntimeException('Order id required');
        }
        return Order::find($order_id);
    }

    /**
     * Get order products
     * @param integer|null $order_id
     * @return mixed
     */
    public function getOrderProducts($order_id)
    {
        if($order_id){
            throw new RuntimeException('Order id required');
        }
        return OrderProduct::where('order_id', $order_id)->get();
    }

}
