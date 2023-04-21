<?php

namespace App\Repositories\AdminPanel;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;

class OrderRepository
{
    public function createOrder($user_id)
    {

        try {
            if(User::find($user_id)){
                    Order::create([
                        'status' => 'unpaid',
                        'user_id' => $user_id
                    ]);
                }
        }catch (\Exception $e){
            throw new $e;
        }
    }

    public function storeOrderProducts($user_id, $products)
    {
        $orders = Order::where('user_id', $user_id)->get('id')->toArray();

        $lastOrder = array_pop($orders);

        foreach ($products as $product){
            OrderProduct::create([
                'product_name' => $product['price_data']['product_data']['name'],
                'quantity' => $product['quantity'],
                'product_price' => $product['price_data']['unit_amount'],
                'order_id' => $lastOrder['id']
            ]);
        }
    }
    public function updateOrderStatus($user_id, $status, $order_id)
    {
        if(!isset($order_id)){
            $orders = Order::where('user_id', $user_id)->get('id')->toArray();
            $lastOrder = array_pop($orders);
            Order::find($lastOrder['id'])->update(['status' => $status]);
        }else{
            Order::find($order_id)->update(['status' => $status]);
        }

    }

    public function deleteOrder($order_id)
    {
        try {
            Order::destroy($order_id);
        }catch (\Exception $e){
            throw new $e;
        }
    }

    public function deleteOrderProducts($order_id)
    {
        $products = OrderProduct::where('order_id', $order_id)->get('id');

        OrderProduct::destroy($products);
    }

    public function getUserOrders($user_id)
    {
        return Order::where('user_id', $user_id)->with('products')->get();
    }

    public function checkUnpaidOrders($user_id)
    {
        $response = false;
        if(Order::where('user_id', $user_id)->where('status', 'unpaid')->exists()){
            $response = true;
        }
        return $response;
    }

    public function getOrderById($order_id)
    {
        return Order::find($order_id);
    }

    public function getOrderProducts($order_id)
    {
        return OrderProduct::where('order_id', $order_id)->get();
    }

}
