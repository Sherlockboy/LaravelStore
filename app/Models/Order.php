<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property User $user
 * @property Collection|OrderItem[] $items
 * @property Address $address
 * @property string $status
 * @property float $final_price
 * @property string $country
 * @property string $city
 * @property string $street
 * @property string $zip
 * @property string $phone
 * @property string $created_at
 */
class Order extends ProductRelatedItemsContainer
{
    /** Order statuses */
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'user_id',
        'address_id',
        'full_name',
        'status',
        'country',
        'city',
        'street',
        'zip',
        'phone',
        'final_price',
    ];

    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
