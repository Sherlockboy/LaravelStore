<?php

use App\Http\Controllers\ProductController;

Route::get('product/{product}', [ProductController::class, 'index'])
    ->name('product.index');
