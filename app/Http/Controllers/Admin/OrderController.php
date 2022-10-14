<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Handles order-related actions done by admin user
 */
class OrderController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * @param Order $order
     * @return View
     */
    public function show(Order $order): View
    {
        return view('admin.order.show', compact('order'));
    }

    /**
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(Order $order): RedirectResponse
    {
        $status = request('order-status');

        if ($order->status != $status) {
            $order->update(['status' => $status]);
        }

        return redirect(url()->previous());
    }
}
