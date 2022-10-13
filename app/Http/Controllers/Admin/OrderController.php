<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Handles order-related actions done by admin user
 */
class OrderController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * @param Order $order
     * @return Application|Factory|View
     */
    public function show(Order $order)
    {
        return view('admin.order.show', compact('order'));
    }

    /**
     * @param Order $order
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Order $order)
    {
        $status = request('order-status');

        if ($order->status != $status) {
            $order->update(['status' => $status]);
        }

        return redirect(url()->previous());
    }
}
