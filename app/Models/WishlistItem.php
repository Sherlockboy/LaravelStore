<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Wishlist $wishlist
 */
class WishlistItem extends ProductRelatedItem
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'product_id',
        'wishlist_id',
    ];

    /**
     * @return BelongsTo
     */
    public function wishlist(): BelongsTo
    {
        return $this->belongsTo(Wishlist::class);
    }
}
