<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_guest',
        'session_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function getFinalPrice(): int
    {
        $finalPrice = 0;
        foreach ($this->items->all() as $cartItem) {
            $finalPrice += $cartItem->product->price * $cartItem->qty;
        }

        return $finalPrice;
    }

    public function clearCart()
    {
        foreach ($this->items as $cartItem) {
            $cartItem->delete();
        }
    }

    public static function merge(Cart $guestCart): void
    {
        $userCart = auth()->user()->cart;
        /** @var CartItem $item */
        foreach ($guestCart->items as $item) {
            $item->update([
                'cart_id' => $userCart->id
            ]);
        }

        $guestCart->delete();
    }

    public static function getCart($createNew = true): ?Cart
    {
        if (auth()->user()) {
            //Get user cart for authorized user
            return auth()->user()->cart;
        } else {
            //Get guest cart by session id
            $cart = Cart::where('session_id', '=', session()->getId())->get()->first();

            //Create new guest cart using session id
            if (!$cart && $createNew) {
                $cart = Cart::create([
                    'session_id' => session()->getId(),
                    'is_guest' => 1
                ]);
            }

            return $cart;
        }
    }
}
