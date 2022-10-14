<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $orders = Order::where('user_id', '=', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('user.account.order.index', compact('orders'));
    }

    /**
     * @return JsonResponse
     */
    public function create(): JsonResponse
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

    /**
     * @param Order $order
     * @return View
     * @throws AuthorizationException
     */
    public function show(Order $order): View
    {
        $this->authorize('view', $order);
        return view('order.show', compact('order'));
    }

    /**
     * Prepare data to create authorized user order
     *
     * @param Address $address
     * @return array
     */
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

    /**
     * Prepare data to create guest order
     *
     * @return array
     */
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
