<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $finalPrice = $user ? $user->cart->getFinalPrice() : 0;

        return view('checkout.index', compact('user', 'finalPrice'));
    }

    public function success()
    {
        $orderId = request('orderId');
        $order = Order::find($orderId);
        $this->authorize('view', $order);
        return view('checkout.success', compact('orderId'));
    }
}
