<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
