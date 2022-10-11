<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('/cart', [CartController::class, 'destroyAll'])->name('cart.destroy.all');

Route::get('/checkout/index', [CheckoutController::class, 'index'])->name('checkout.shipping');
Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::post('order/create', [OrderController::class, 'create'])->name('order.create');