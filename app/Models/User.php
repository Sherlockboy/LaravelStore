<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const USER_TYPE = 'user';

    public const ADMIN_TYPE = 'admin';

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'type',
        'first_name',
        'last_name'
    ];

    /**
     * @inheritdoc
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function wishlist(): HasOne
    {
        return $this->hasOne(Wishlist::class);
    }

    /**
     * @return Address|null
     */
    public function getDefaultAddress(): ?Address
    {
        return Address::where('user_id', $this->id)
            ->where('is_default', 1)
            ->get()
            ->first();
    }

    /**
     * @inheritdoc
     *
     * Create cart instance for new user
     * Create wishlist instance for new user
     */
    protected static function boot()
    {
        parent::boot();
        User::created(
            function (User $user) {
                $user->cart()->create([
                    'user_id' => $user->id
                ]);

                $user->wishlist()->create([
                    'user_id' => $user->id
                ]);
            }
        );
    }
}
