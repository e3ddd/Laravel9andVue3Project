<?php

namespace App\Repositories\AdminPanel;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    public function createOrder($session_id)
    {
        $order = new Order();
        $order->session_id = $session_id;
        $order->status = 'unpaid';
        $order->user_id = Auth::user()->id;
        $order->amount = 0;
        $order->save();
    }

    public function storeOrderProducts($session_id, $products)
    {
        $order = Order::where('session_id', $session_id)->first();
        $amount = 0;
        foreach ($products as $product){

            $amount += ($product['price_data']['unit_amount'] * $product['quantity']);
            OrderProduct::create([
                'product_name' => $product['price_data']['product_data']['name'],
                'quantity' => $product['quantity'],
                'product_price' => $product['price_data']['unit_amount'],
                'order_id' => $order->id
            ]);
        }
        $order->update(['amount' => $amount]);
    }
    public function updatePayStatus($session_id)
    {
        if(Order::where('session_id', $session_id)->exists()){
            Order::where('session_id', $session_id)->update(['status' => 'paid']);
        }
    }
}
