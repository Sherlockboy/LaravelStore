<?php

namespace App\Http\Controllers;

use App\Models\Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cart = Cart::getCart();
        $finalPrice = $cart->getFinalPrice();

        return view('checkout.index', compact('cart', 'user', 'finalPrice'));
    }

    public function success()
    {
        $orderId = request('orderId');
        return view('checkout.success', compact('orderId'));
    }
}
