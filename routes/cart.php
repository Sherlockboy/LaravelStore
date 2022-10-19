<?php

use App\Http\Controllers\CartController;

Route::get('cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('cart/store', [CartController::class, 'store'])
    ->name('cart.store');

Route::delete('cart/{cartItem}', [CartController::class, 'destroy'])
    ->name('cart.destroy');

Route::delete('cart', [CartController::class, 'destroyAll'])
    ->name('cart.destroy.all');

Route::post('cart/{cartItem}', [CartController::class, 'update'])
    ->name('cart.update');