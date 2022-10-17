<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property User $user
 * @property bool $is_default
 * @property string $title
 * @property string $country
 * @property string $city
 * @property string $street
 * @property string $zip
 * @property string $phone
 */
class Address extends Model
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'user_id',
        'is_default',
        'title',
        'country',
        'city',
        'street',
        'zip',
        'phone'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
