<?php

namespace App\Http\Controllers;

use App\Repositories\AdminPanel\OrderRepository;
use App\Repositories\AdminPanel\ProductRepository;
use App\Services\AdminPanel\OrderService;
use App\Services\ShoppingCartService;
use Illuminate\Support\Facades\DB;

class StripeController extends Controller
{

    public function updateOrderStatus($user_id, $status, $order_id = null)
    {
        $orderService = app(OrderService::class);
        $orderService->updateOrderStatus($user_id, $status, $order_id);
    }

    public function webhook()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            return response($e, 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
           return response($e, 400);
        }

// Handle the event
        switch ($event->type) {
            case 'payment_intent.created':
                $session = $event->data->object;
                if($session->metadata->order_id == null){
                    $this->updateOrderStatus($session->metadata->customer_id, 'created');
                }else{
                    $this->updateOrderStatus($session->metadata->customer_id, 'created', $session->metadata->order_id);
                }

            case 'payment_intent.canceled':
                $session = $event->data->object;
                if($session->metadata->order_id == null){
                    $this->updateOrderStatus($session->metadata->customer_id, 'canceled');
                }else{
                    $this->updateOrderStatus($session->metadata->customer_id, 'canceled', $session->metadata->order_id);
                }

            case 'payment_intent.succeeded':
                $session = $event->data->object;
                if($session->metadata->order_id == null){
                    $this->updateOrderStatus($session->metadata->customer_id, 'paid');
                }else{
                    $this->updateOrderStatus($session->metadata->customer_id, 'paid', $session->metadata->order_id);
                }

            case 'checkout.session.completed':
                $session = $event->data->object;
                if($session->metadata->order_id == null){
                    $this->updateOrderStatus($session->metadata->customer_id, 'completed');
                }else{
                    $this->updateOrderStatus($session->metadata->customer_id, 'completed', $session->metadata->order_id);
                }
                break;


            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('', 200);
    }
}


