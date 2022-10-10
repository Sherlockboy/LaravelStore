<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;

class BillingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $finalPrice = 0;
        if ($user) {
            foreach ($user->cart->cartItems->all() as $cartItem) {
                $finalPrice += $cartItem->product->price * $cartItem->qty;
            }
        }

        return view('checkout.billing', compact('user', 'finalPrice'));
    }
}
