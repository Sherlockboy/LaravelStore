<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders', compact('orders'));
    }

    public function update(Order $order)
    {
        $status = request('order-status');

        if ($order->status != $status) {
            $order->update(['status' => $status]);
        }

        return redirect(url()->previous());

    }
}
