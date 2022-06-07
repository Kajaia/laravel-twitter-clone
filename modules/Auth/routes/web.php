<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\app\Http\Controllers\EmailVerificationController;
use Modules\Auth\app\Http\Controllers\LoginController;
use Modules\Auth\app\Http\Controllers\LogoutController;
use Modules\Auth\app\Http\Controllers\RegisterController;
use Modules\Auth\app\Http\Controllers\ResetPasswordController;

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

// Guest routes
Route::middleware('guest')->group(function() {
    // Login
    Route::view('/login', 'auth::login')->name('auth.login');
    Route::post('/login', LoginController::class)->name('login');

    // Register
    Route::view('/register', 'auth::register')->name('auth.register');
    Route::post('/register', RegisterController::class)->name('register');

    // Password reset
    Route::view('/forgot-password', 'auth::forgot-password')->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'reset'])
        ->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'token'])
        ->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'update'])
        ->name('password.update');
});

// Authenticated user routes
Route::middleware('auth')->group(function() {
    // Email verification
    Route::view('/email/verify', 'auth::verify-email')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Logout
    Route::post('/logout', LogoutController::class)->name('logout');
});