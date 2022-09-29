<?php
Route::get('/category/{categoryId}', [App\Http\Controllers\CategoryController::class, 'index'])
    ->name('category.index');
