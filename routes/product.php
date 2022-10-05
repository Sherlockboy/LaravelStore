<?php

use App\Http\Controllers\ProductController;

Route::middleware('admin')->group(function () {
    Route::get('product/create', [ProductController::class, 'create'])
        ->name('product.create');

    Route::post('product/store', [ProductController::class, 'store'])
        ->name('product.store');

    Route::get('product/edit/{product}', [ProductController::class, 'edit'])
        ->name('product.edit');

    Route::post('product/update/{product}', [ProductController::class, 'update'])
        ->name('product.update');
});

Route::get('product/{product}', [ProductController::class, 'index'])->name('product.index');
