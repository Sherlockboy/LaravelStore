<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;


class CartController extends Controller
{
    public function add(Product $product)
    {
        CartItem::create([
            'product_id' => $product->id,
            'cart_id' => auth()->user()->cart->id,
        ]);

        return response()->json(['name' => $product->name]);
    }

    public function index()
    {
        $user = auth()->user();
        $finalPrice = 0;
        foreach ($user->cart->cartItems->all() as $cartItem) {
            $finalPrice += $cartItem->product->price;
        }


        return view('cart.index', compact('user', 'finalPrice'));
    }

    public function destroy(CartItem $cartItem)
    {
        $productName = $cartItem->product->name;
        $cartItem->delete();
        return response()->json(['name' => $productName]);
    }
}
