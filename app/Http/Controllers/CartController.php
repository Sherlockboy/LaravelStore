<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use function Symfony\Component\Translation\t;

class CartController extends Controller
{
    public function store()
    {
        $data = request()->all();
        $productId = $data['productId'];
        $cartItem = CartItem::where('product_id', $productId)
            ->where('cart_id', auth()->user()->cart->id)
            ->get()
            ->first();

        if($cartItem) {
            $cartItem->update(['qty' => $cartItem->qty + 1]);
        } else {
            $cartItem = CartItem::create([
                'product_id' => $productId,
                'cart_id' => auth()->user()->cart->id,
                'qty' => 1
            ]);
        }

        return response()->json(['cartItemId' => $cartItem->id]);
    }

    public function index()
    {
        $user = auth()->user();
        $finalPrice = $user ? $user->cart->getFinalPrice() : 0;
        if ($user) {
            return view('checkout.cart.index', compact('user', 'finalPrice'));
        }

        return redirect(route('login'));
    }

    public function destroy(CartItem $cartItem)
    {
        $this->authorize('delete', $cartItem);
        $productName = $cartItem->product->name;
        $cartItem->delete();
        return response()->json(['name' => $productName]);
    }

    public function destroyAll()
    {
        $cart = auth()->user()->cart;
        $this->authorize('delete', $cart);

        $cart->clearCart();

        return response()->json('Success');
    }
}
