<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use function Symfony\Component\Translation\t;


class CartController extends Controller
{
    public function add(Product $product)
    {
        $cartItem = CartItem::where('product_id', $product->id)
            ->where('cart_id', auth()->user()->cart->id)
            ->get()
            ->first();

        if($cartItem) {
            $cartItem->update(['qty' => $cartItem->qty + 1]);
        } else {
            CartItem::create([
                'product_id' => $product->id,
                'cart_id' => auth()->user()->cart->id,
                'qty' => 1
            ]);

        }

        return response()->json(['name' => $product->name]);
    }

    public function index()
    {
        $user = auth()->user();
        $finalPrice = 0;
        foreach ($user->cart->cartItems->all() as $cartItem) {
            $finalPrice += $cartItem->product->price * $cartItem->qty;
        }


        return view('checkout.cart.index', compact('user', 'finalPrice'));
    }

    public function destroy(CartItem $cartItem)
    {
        $productName = $cartItem->product->name;
        $cartItem->delete();
        return response()->json(['name' => $productName]);
    }

    public function destroyAll()
    {
        $cart = auth()->user()->cart;
        foreach ($cart->cartItems as $cartItem) {
            $cartItem->delete();
        }

        return response()->json('Success');
    }
}
