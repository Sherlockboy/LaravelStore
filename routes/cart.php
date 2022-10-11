<?php

use App\Http\Controllers\CartController;

Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('cart', [CartController::class, 'destroyAll'])->name('cart.destroy.all');