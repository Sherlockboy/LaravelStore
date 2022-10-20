<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

Route::get('checkout/index', [CheckoutController::class, 'index'])
    ->name('checkout.shipping');

Route::get('checkout/success', [CheckoutController::class, 'success'])
    ->name('checkout.success');
