<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Contracts\View\View;

class CheckoutController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $user = auth()->user();
        $cart = Cart::getCart();
        $finalPrice = $cart->getFinalPrice();

        return view('checkout.index', compact('cart', 'user', 'finalPrice'));
    }

    /**
     * @return View
     */
    public function success(): View
    {
        $orderId = request('orderId');
        return view('checkout.success', compact('orderId'));
    }
}
