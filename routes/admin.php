<?php

use App\Http\Controllers\AdminController;

Route::get(env('APP_ADMIN_PANEL_URL'), [AdminController::class, 'index'])->name('admin.index');
Route::post(env('APP_ADMIN_PANEL_URL') . '/login', [AdminController::class, 'login'])->name('admin.login');