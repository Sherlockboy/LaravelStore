<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;


class CartController extends Controller
{
    public function add(Product $product)
    {
        /** @var CartItem $cartItem */
        $cartItem = CartItem::create([
            'product_id' => $product->id,
            'cart_id' => auth()->user()->cart->id,

        ]);



        return response()->json('Success');
    }
}