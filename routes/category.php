<?php

use App\Http\Controllers\CategoryController;

Route::middleware('admin')->group(function () {
    Route::get('category/create', [CategoryController::class, 'create'])
        ->name('category.create');

    Route::post('category/store', [CategoryController::class, 'store'])
        ->name('category.store');
});

Route::get('category/{category}', [CategoryController::class, 'index'])->name('category.index');
