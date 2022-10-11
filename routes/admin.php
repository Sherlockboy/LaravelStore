<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;

Route::middleware('admin')->group(function () {
    //Category
    Route::get('category/create', [CategoryController::class, 'create'])
        ->name('category.create');

    Route::post('category/store', [CategoryController::class, 'store'])
        ->name('category.store');

    //Product
    Route::get('product/create', [ProductController::class, 'create'])
        ->name('product.create');

    Route::post('product/store', [ProductController::class, 'store'])
        ->name('product.store');

    Route::get('product/edit/{product}', [ProductController::class, 'edit'])
        ->name('product.edit');

    Route::post('product/update/{product}', [ProductController::class, 'update'])
        ->name('product.update');

    //AdminController
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('admin/category', [CategoryController::class, 'index'])
        ->name('admin.category.index');
    Route::get('admin/product', [ProductController::class, 'index'])
        ->name('admin.product.index');
    Route::get('admin/order', [OrderController::class, 'index'])
        ->name('admin.order.index');

    Route::patch('admin/order/{order}', [OrderController::class, 'update'])
        ->name('admin.order.update');
});
