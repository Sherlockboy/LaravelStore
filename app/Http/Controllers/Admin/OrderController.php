<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.order.show', compact('order'));
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
