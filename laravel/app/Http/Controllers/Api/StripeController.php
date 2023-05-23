<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        $items = $request->input('items');
        $arrayItems = [];

        foreach ($items as $item) {
            $arrayItems[] = [
                'price' => $item['id'],
                'quantity' => $item['quantity'],
            ];
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $arrayItems,
            'mode' => 'payment',
            'success_url' => 'http://client11.insjoaquimmir.cat/success',
            'cancel_url' => 'http://client11.insjoaquimmir.cat/cancel',
        ]);

        return response()->json([
            'url' => $session->url,
        ]);
    }
}
