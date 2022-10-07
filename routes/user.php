<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
    Route::post('/account/update', [UserController::class, 'update'])->name('user.update');

    Route::get('/account', [UserController::class, 'index'])->name('user.account');
});

Route::middleware('auth')->group(function () {
    Route::post('/address/update', [AddressController::class, 'update'])->name('address.update');
});
