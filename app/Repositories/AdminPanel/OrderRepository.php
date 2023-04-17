<?php

namespace App\Repositories\AdminPanel;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
    public function updateOrderStatus($user_id)
    {
        $orders = Order::where('user_id', $user_id)->get('id')->toArray();

        $lastOrder = array_pop($orders);

        Order::find($lastOrder['id'])->update(['status' => 'paid']);
    }

    public function getUserOrders($user_id)
    {
        return Order::where('user_id', $user_id)->with('products')->get();
    }
}
