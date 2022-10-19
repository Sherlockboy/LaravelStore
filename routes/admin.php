<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;

Route::middleware('admin')->group(function () {
    //Admin Navigation
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('admin/category', [CategoryController::class, 'index'])
        ->name('admin.category.index');
    Route::get('admin/product', [ProductController::class, 'index'])
        ->name('admin.product.index');
    Route::get('admin/order', [OrderController::class, 'index'])
        ->name('admin.order.index');

    //Category
    Route::get('category/create', [CategoryController::class, 'create'])
        ->name('admin.category.create');

    Route::post('category/store', [CategoryController::class, 'store'])
        ->name('admin.category.store');

    Route::get('category/edit/{category}', [CategoryController::class, 'edit'])
        ->name('admin.category.edit');

    Route::post('category/update/{category}', [CategoryController::class, 'update'])
        ->name('admin.category.update');

    Route::delete('category/{category}', [CategoryController::class, 'destroy'])
        ->name('admin.category.destroy');

    //Product
    Route::get('product/create', [ProductController::class, 'create'])
        ->name('admin.product.create');

    Route::post('product/store', [ProductController::class, 'store'])
        ->name('admin.product.store');

    Route::get('product/edit/{product}', [ProductController::class, 'edit'])
        ->name('admin.product.edit');

    Route::post('product/update/{product}', [ProductController::class, 'update'])
        ->name('admin.product.update');

    Route::delete('product/{product}', [ProductController::class, 'destroy'])
        ->name('admin.product.destroy');

    //Order
    Route::patch('admin/order/{order}', [OrderController::class, 'update'])
        ->name('admin.order.update');
    Route::get('admin/order/{order}', [OrderController::class, 'show'])
        ->name('admin.order.show');
});
