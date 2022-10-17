<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class represents abstract product-related item.
 * Item belongs to instance of ProductRelatedContainer (ex. Cart Item belong to Cart).
 * Item belongs to product and serves as link between product and ProductRelatedContainer.
 * Call item->product should return instance of App/Models/Product.
 *
 * @property int $id
 * @property Product $product
 */
class ProductRelatedItem extends Model
{
    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
