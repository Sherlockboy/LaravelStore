<?php

use App\Http\Controllers\OrderController;

Route::post('order/create', [OrderController::class, 'create'])->name('order.create');