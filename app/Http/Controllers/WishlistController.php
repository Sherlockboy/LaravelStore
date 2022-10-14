<?php

namespace App\Http\Controllers;

use App\Models\WishlistItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class WishlistController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $wishlist = auth()->user()->wishlist;
        return view('user.account.wishlist.index', compact('wishlist'));
    }

    /**
     * @return JsonResponse
     */
    public function store(): JsonResponse
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

    /**
     * @param WishlistItem $wishlistItem
     * @return JsonResponse
     */
    public function destroy(WishlistItem $wishlistItem): JsonResponse
    {
        $productName = $wishlistItem->product->name;
        $wishlistItem->delete();

        return response()->json(['name' => $productName]);
    }
}
