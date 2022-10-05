<?php

use App\Http\Controllers\CartController;

Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');