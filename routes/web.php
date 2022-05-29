<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

// Auth routes
Auth::routes(['reset' => false]);

Route::middleware('auth')->group(function() {
    // Email verification routes
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');
    Route::view('/email/verify', 'auth.verify')->name('verification.notice');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.resend');

    // Homepage route
    Route::view('/', 'index')->middleware('verified')->name('homepage');

    // Update profile details
    Route::post('/{slug}/update', [UserController::class, 'update'])
        ->name('update.profile');
});

// Profile and specific tweet routes
Route::middleware('verified-or-guest')->group(function() {
    Route::get('/{slug}', [UserController::class, 'profile'])->name('profile');
    Route::get('/tweet/{id}', TweetController::class)
        ->whereNumber('id')
        ->name('specific.tweet');
});