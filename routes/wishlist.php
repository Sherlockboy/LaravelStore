<?php

use App\Http\Controllers\WishlistController;

Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])
        ->name('wishlist.index');
    Route::delete('/wishlist/{wishlistItem}', [WishlistController::class, 'destroy'])
        ->name('wishlist.destroy');
    Route::post('/wishlist/store', [WishlistController::class, 'store'])
        ->name('wishlist.store');
});