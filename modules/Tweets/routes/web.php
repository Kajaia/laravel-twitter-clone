<?php

use Illuminate\Support\Facades\Route;
use Modules\Tweets\app\Http\Controllers\TweetController;

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

// Specific tweet route
Route::middleware('verified-or-guest')->group(function() {
    Route::get('/tweet/{id}', TweetController::class)
        ->whereNumber('id')
        ->name('specific.tweet');
});