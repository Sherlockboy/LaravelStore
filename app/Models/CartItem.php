<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Cart $cart
 * @property int $qty
 */
class CartItem extends ProductRelatedItem
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'cart_id',
        'product_id',
        'qty'
    ];

    /**
     * @return BelongsTo
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}
