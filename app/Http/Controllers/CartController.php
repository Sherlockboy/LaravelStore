<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function store()
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

    public function index()
    {
        $cart = Cart::getCart();
        $finalPrice = $cart->getFinalPrice();

        return view('checkout.cart.index', compact('cart', 'finalPrice'));

    }

    public function destroy(CartItem $cartItem)
    {
        $cart = Cart::getCart();

        if ($cart->id == $cartItem->cart->id) {
            $productName = $cartItem->product->name;
            $cartItem->delete();
        }

        return response()->json(['name' => $productName]);
    }

    public function destroyAll()
    {
        $cart = Cart::getCart();
        $cart->clearCart();

        return response()->json('Success');
    }
}
