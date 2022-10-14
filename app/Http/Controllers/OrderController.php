<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use http\Env\Response;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', '=', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('user.account.order.index', compact('orders'));
    }

    public function create()
    {
        $cart = Cart::getCart();

        if (request('addressId') && $address = Address::find(request('addressId'))) {
            $orderData = $this->prepareOrderData($address);
        } else {
            $orderData = $this->prepareGuestOrderData();
        }

        $orderData['status'] = Order::STATUS_PENDING;
        $orderData['final_price'] = $cart->getFinalPrice();

        try {
            $order = Order::create($orderData);

            foreach ($cart->items as $cartItem) {
                $orderItemData = [
                    'product_id' => $cartItem->product->id,
                    'order_id' => $order->id,
                    'qty' => $cartItem->qty
                ];

                OrderItem::create($orderItemData);
            }

            $cart->clearCart();

            //TODO send email!
            //TODO: manage responses

            return response()->json(['orderId' => $order->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        return view('order.show', compact('order'));
    }

    private function prepareOrderData(Address $address): array
    {
        return [
            'user_id' => auth()->user()->id,
            'country' => $address->country,
            'city' => $address->city,
            'street' => $address->street,
            'zip' => $address->zip,
            'phone' => $address->phone,
            'address_id' => $address->id,
        ];
    }

    private function prepareGuestOrderData(): array
    {
        return [
            'country' => request('country'),
            'city' => request('city'),
            'street' => request('street'),
            'zip' => request('zip'),
            'phone' => request('phone'),
            'is_guest' => 1
        ];
    }
}
