<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property User $user
 * @property Collection|WishlistItem[] $items
 */
class Wishlist extends Model
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'user_id'
    ];

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(WishlistItem::class);
    }

    public function getItemByRelatedId(int $relatedId): ?WishlistItem
    {
        return $this->items->where('product_id', '=', $relatedId)->first();
    }
}
