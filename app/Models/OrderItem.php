<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Order $order
 * @property int $qty
 */
class OrderItem extends ProductRelatedItem
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'product_id',
        'order_id',
        'qty'
    ];



    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
