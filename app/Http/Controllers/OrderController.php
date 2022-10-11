<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function create()
    {
        $cart = auth()->user()->cart;
        $address = Address::find(request('addressId'));

        $orderData = [
            'user_id' => auth()->user()->id,
            'address_id' => $address->id,

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


    }
}
