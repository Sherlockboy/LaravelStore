<?php

use App\Http\Controllers\Dev\EmailPreviewController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('dev/preview-email/new-order/{order}', [EmailPreviewController::class, 'newOrder']);
Route::get('dev/preview-email/new-order-guest/{order}', [EmailPreviewController::class, 'newOrderGuest']);

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/category.php';
require __DIR__ . '/product.php';
require __DIR__ . '/cart.php';
require __DIR__ . '/order.php';
require __DIR__ . '/checkout.php';
require __DIR__ . '/user.php';
require __DIR__ . '/wishlist.php';
