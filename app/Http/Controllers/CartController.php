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

        return response()->json(['cartItemId' => $cartItem->id]);
    }

    /**
     * @param CartItem $cartItem
     * @return JsonResponse
     */
    public function destroy(CartItem $cartItem): JsonResponse
    {
        $cart = Cart::getCart();

        if ($cart->id == $cartItem->cart->id) {
            $productName = $cartItem->product->name;
            $cartItem->delete();
        }

        return response()->json(['name' => $productName]);
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
}
