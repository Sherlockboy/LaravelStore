<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

    Route::get('admin/category', [AdminCategoryController::class, 'index'])
        ->name('admin.category.index');

    Route::get('admin/product', [AdminProductController::class, 'index'])
        ->name('admin.product.index');

    Route::get('admin/order', [AdminOrderController::class, 'index'])
        ->name('admin.order.index');
    Route::patch('admin/order/{order}', [AdminOrderController::class, 'edit'])->name('admin.order.edit');
});
