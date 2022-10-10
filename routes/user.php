<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
    Route::post('/account/update', [UserController::class, 'update'])->name('user.update');

    Route::get('/account', [UserController::class, 'index'])->name('user.account');
});

Route::middleware('auth')->group(function () {
    Route::post('/address/update/{address}', [AddressController::class, 'update'])->name('address.update');

    Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');

    Route::delete('/address/{address}', [AddressController::class, 'delete'])->name('address.delete');

    Route::get('/address', [AddressController::class, 'index'])->name('user.address.index');
});
