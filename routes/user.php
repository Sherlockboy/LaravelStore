<?php

use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
    Route::post('/account/update', [UserController::class, 'update'])->name('user.update');

    Route::get('/account', function () {
        return view('user.account');
    })->name('user.account');
});
