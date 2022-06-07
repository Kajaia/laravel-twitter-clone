<?php

use App\Http\Controllers\UserController;
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

// Authenticated user routes
Route::middleware('auth')->group(function() {
    // Homepage route
    Route::view('/', 'index')->middleware('verified')->name('homepage');

    // Update profile details
    Route::post('/{slug}/update', [UserController::class, 'update'])
        ->name('update.profile');
});

// Email verified user or guest routes
Route::middleware('verified-or-guest')->group(function() {
    // Profile route
    Route::get('/{slug}', [UserController::class, 'profile'])->name('profile');
});