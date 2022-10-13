<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function create()
    {
        /** @var Cart $cart */
        $cart = auth()->user()->cart;

        /** @var Address $address */
        $address = Address::find(request('addressId'));

        $orderData = [
            'user_id' => auth()->user()->id,
            'address_id' => $address->id,
            'status' => Order::STATUS_PENDING,
            'country' => $address->country,
            'city' => $address->city,
            'street' => $address->street,
            'zip' => $address->zip,
            'phone' => $address->phone,
            'final_price' => $cart->getFinalPrice(),
        ];

        $order = Order::create($orderData);

        foreach ($cart->cartItems as $cartItem) {
            $orderItemData = [
                'product_id' => $cartItem->product->id,
                'order_id' => $order->id,
                'qty' => $cartItem->qty
            ];

            OrderItem::create($orderItemData);
        }

        $cart->clearCart();

        return response()->json(['orderId' => $order->id]);
    }

    public function index()
    {
        $orders = Order::where('user_id', '=', auth()->user()->id)
        ->orderBy('created_at', 'DESC')
        ->paginate(10);
        return view('user.account.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        return view('order.show', compact('order'));
    }
}
