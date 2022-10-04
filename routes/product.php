<?php

use App\Http\Controllers\ProductController;

Route::middleware('admin')->group(function () {
    Route::get('product/create', [\App\Http\Controllers\ProductController::class, 'create'])
        ->name('product.create');

    Route::post('product/store', [\App\Http\Controllers\ProductController::class, 'store'])
        ->name('product.store');
});

Route::get('product/{product}', [ProductController::class, 'index'])->name('product.index');
