<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShoppingCart;
use App\Services\AdminPanel\OrderService;
use App\Services\ShoppingCartService;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function updatePayStatus($session_id)
    {
        $orderService = app(OrderService::class);
        $orderService->updatePayStatus($session_id);
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


            case 'checkout.session.completed':
                $session = $event->data->object;

                $this->updatePayStatus($session->id);
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('', 200);
    }
}


