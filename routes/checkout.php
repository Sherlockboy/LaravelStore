<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Checkout\BillingController;
use App\Http\Controllers\Checkout\ShippingController;

Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('/cart', [CartController::class, 'destroyAll'])->name('cart.destroy.all');

Route::get('/checkout/shipping', [ShippingController::class, 'index'])->name('checkout.shipping');

Route::get('/checkout/billing', [BillingController::class, 'index'])->name('checkout.billing');