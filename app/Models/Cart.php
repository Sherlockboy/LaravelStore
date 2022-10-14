<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

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
        foreach ($this->cartItems->all() as $cartItem) {
            $finalPrice += $cartItem->product->price * $cartItem->qty;
        }

        return $finalPrice;
    }

    public function clearCart()
    {
        foreach ($this->cartItems as $cartItem) {
            $cartItem->delete();
        }
    }
}
