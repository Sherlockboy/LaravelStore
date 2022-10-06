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
        return view('cart.index', compact('user'));
    }
}
