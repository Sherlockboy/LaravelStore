<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WishlistItem;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = auth()->user()->wishlist;
        return view('user.account.wishlist.index', compact('wishlist'));
    }

    public function store()
    {
        $data = request()->all();
        $productId = $data['productId'];
        $user = auth()->user();
        $wishlistItem = WishlistItem::create([
            'product_id' => $productId,
            'wishlist_id' => $user->wishlist->id,
        ]);

        return response()->json(['wishlistItemId' => $wishlistItem->id]);
    }

    public function destroy(WishlistItem $wishlistItem)
    {
        $productName = $wishlistItem->product->name;
        $wishlistItem->delete();

        return response()->json(['name' => $productName]);
    }
}
