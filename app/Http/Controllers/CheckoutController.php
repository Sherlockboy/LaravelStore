<?php

namespace App\Http\Controllers;

use App\Models\Checkout\PaymentMethod;
use App\Models\Checkout\ShipmentMethod;
use App\Models\Order;
class CheckoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $finalPrice = $user ? $user->cart->getFinalPrice() : 0;
        $paymentMethods = PaymentMethod::all();
        $shipmentMethods = ShipmentMethod::all();

        return view('checkout.index', compact(
            'user',
            'finalPrice',
            'paymentMethods',
            'shipmentMethods'
        ));
    }

    public function success()
    {
        $orderId = request('orderId');
        $order = Order::find($orderId);
        $this->authorize('view', $order);
        return view('checkout.success', compact('orderId'));
    }
}
