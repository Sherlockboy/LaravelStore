<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property User $user
 * @property Collection|CartItem[] $items
 * @property string $session_id
 * @property bool $is_guest
 */
class Cart extends ProductRelatedItemsContainer
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'user_id',
        'is_guest',
        'session_id'
    ];

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
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get total cart price
     * 
     * @return int
     */
    public function getFinalPrice(): int
    {
        $finalPrice = 0;
        /** @var CartItem $cartItem */
        foreach ($this->items->all() as $cartItem) {
            $finalPrice += $cartItem->product->price * $cartItem->qty;
        }

        return $finalPrice;
    }

    /**
     * Remove all items from cart
     *
     * @return void
     */
    public function clearCart(): void
    {
        foreach ($this->items as $cartItem) {
            $cartItem->delete();
        }
    }

    /**
     * Merge guest and user cart after login.
     * Cart items for guest cart are added user cart.
     * If product is already in user cart, product qty in user will be increased by guest cart product qty
     *
     * @param Cart $guestCart
     * @return void
     */
    public static function merge(Cart $guestCart): void
    {
        /** @var Cart $userCart */
        $userCart = auth()->user()->cart;

        /** @var CartItem $guestCartItem */
        foreach ($guestCart->items as $guestCartItem) {
            $cartItemUpdateData = [
                'cart_id' => $userCart->id
            ];

            $userCartItem = $userCart->getItemByRelatedId('product_id', $guestCartItem->product->id);

            if ($userCartItem) {
                // If user has same product in the cart, result qty must be equal to guest gat qty + user cart qty
                $cartItemUpdateData['qty'] = $guestCartItem->qty + $userCartItem->qty;
                $userCartItem->delete();
            }

            $guestCartItem->update($cartItemUpdateData);
        }

        $guestCart->delete();
    }

    /**
     * TODO: rewrite guest cart using cookie instead of session
     * Get cart instance
     * For authorized user returns user cart
     * For unauthorized user returns guest cart (by session id).
     * If guest cart doesn't exist, creates new guest cart and returns it.
     * If $createNew param == false, returns null instead of creating new guest cart
     *
     * @param bool $createNew
     * @return Cart|null
     */
    public static function getCart(bool $createNew = true): ?Cart
    {
        if (auth()->user()) {
            //Get user cart for authorized user
            return auth()->user()->cart;
        } else {
            //Get guest cart by session id
            $cart = Cart::where('session_id', '=', session()->getId())->get()->first();

            //Create new guest cart using session id
            if (!$cart && $createNew) {
                $cart = Cart::create([
                    'session_id' => session()->getId(),
                    'is_guest' => 1
                ]);
            }

            return $cart;
        }
    }
}
