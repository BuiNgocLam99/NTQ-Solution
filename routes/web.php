<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\Products;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('sign-up', [SignUpController::class, 'index'])->name('auth.sign-up');
Route::post('sign-up', [SignUpController::class, 'create'])->name('auth.post-sign-up');

Route::get('sign-in', [SignInController::class, 'index'])->name('auth.sign-in');
Route::post('sign-in', [SignInController::class, 'login'])->name('auth.post-sign-in');
Route::post('logout', [SignInController::class, 'logout'])->name('auth.post-logout');

Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name('auth.forgot-password');
Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('auth.post-forgot-password');

Route::get('', [ProductController::class, 'index'])->name('user.products');

// Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('products', [AdminProductController::class, 'index'])->name('admin.products');
    Route::get('create-product', [AdminProductController::class, 'create'])->name('admin.create-product');
    Route::post('store-product', [AdminProductController::class, 'store'])->name('admin.store-product');
// });
