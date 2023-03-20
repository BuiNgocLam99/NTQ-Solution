<?php

use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
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
