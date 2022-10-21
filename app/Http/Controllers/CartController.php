<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $cart = Cart::getCart();
        $finalPrice = $cart->getFinalPrice();

        return view('checkout.cart.index', compact('cart', 'finalPrice'));
    }

    /**
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $data = request()->all();
        $productId = $data['productId'];
        $cart = Cart::getCart();

        /** @var CartItem $cartItem */
        $cartItem = CartItem::where('product_id', $productId)
            ->where('cart_id', $cart->id)
            ->get()
            ->first();

        if ($cartItem) {
            $cartItem->update(['qty' => $cartItem->qty + 1]);
        } else {
            $cartItem = CartItem::create([
                'product_id' => $productId,
                'cart_id' => $cart->id,
                'qty' => 1
            ]);
        }

        return response()->json(['total_qty' => $cartItem->cart->getTotalItemQty()]);
    }

    /**
     * @param CartItem $cartItem
     * @return JsonResponse
     */
    public function update(CartItem $cartItem): JsonResponse
    {
        $newQty = match (request('type')) {
            'increase' => $cartItem->qty + 1,
            'decrease' => $cartItem->qty - 1,
            default => request('qty'),
        };

        if ($newQty == 0) {
            $cartItem->delete();
        } else {
            $cartItem->update(['qty' => $newQty]);
        }

        return response()->json([
            'qty' => $newQty,
            'subtotal' => $cartItem->qty * $cartItem->product->price,
            'final_price' => $cartItem->cart->getFinalPrice(),
            'total_qty' => $cartItem->cart->getTotalItemQty()
        ]);
    }

    /**
     * @param CartItem $cartItem
     * @return JsonResponse
     */
    public function destroy(CartItem $cartItem): JsonResponse
    {
        $cart = Cart::getCart();

        if ($cart->id == $cartItem->cart->id) {
            $cartItem->delete();
        }

        return response()->json(['total_qty' => $cartItem->cart->getTotalItemQty()]);
    }

    /**
     * Remove all products from the cart
     *
     * @return JsonResponse
     */
    public function destroyAll(): JsonResponse
    {
        $cart = Cart::getCart();
        $cart->clearCart();

        return response()->json('Success');
    }

    public function getItemsCount(): JsonResponse
    {
        $count = 0;
        $cart = Cart::getCart(false);
        if ($cart) {
            foreach ($cart->items as $item) {
                $count += $item->qty;
            }
        }

        return response()->json(['count' => $count]);
    }
}
