<?php

namespace App\Http\Controllers;

use App\Mail\NewOrder;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Rules\PhoneNumber;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
        //TODO: check throttle
        $cart = Cart::getCart();

        try {
            if (request('addressId') && $address = Address::find(request('addressId'))) {
                $orderData = $this->prepareOrderData($address);
            } else {
                $orderData = $this->prepareGuestOrderData();
            }

            $orderData['status'] = Order::STATUS_PENDING;
            $orderData['final_price'] = $cart->getFinalPrice();

            /** @var Order $order */
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
            Mail::to($orderData['email'])->send(new NewOrder($order));

            return response()->json(['orderId' => $order->id]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 422);
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
        $data = [
            'user_id' => auth()->user()->id,
            'full_name' => $address->full_name,
            'email' => auth()->user()->email,
            'country' => $address->country,
            'city' => $address->city,
            'street' => $address->street,
            'zip' => $address->zip,
            'phone' => $address->phone,
            'address_id' => $address->id,
        ];

        return $this->validateOrderData($data);
    }

    /**
     * Prepare data to create guest order
     *
     * @return array
     */
    private function prepareGuestOrderData(): array
    {
        $data = [
            'full_name' => request('full_name'),
            'email' => request('email'),
            'country' => request('country'),
            'city' => request('city'),
            'street' => request('street'),
            'zip' => request('zip'),
            'phone' => request('phone'),
            'is_guest' => 1
        ];

        return $this->validateOrderData($data);
    }

    /**
     * @param array $data
     * @return array
     */
    private function validateOrderData(array $data): array
    {
        return Validator::validate($data, [
                'full_name' => ['required', 'string'],
                'email' => ['required', 'email', 'string'],
                'country' => ['required', 'string'],
                'city' => ['required', 'string'],
                'street' => ['required', 'string'],
                'zip' => ['required', 'string'],
                'phone' => ['required', 'string', new PhoneNumber()],
                'user_id' => ['nullable'],
                'address_id' => ['nullable'],
            ]
        );
    }
}
