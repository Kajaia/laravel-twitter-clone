<?php

use App\Http\Controllers\HomeController;
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

Auth::routes([
    'reset' => false
]);

Route::middleware('auth')->group(function() {
    Route::get('/', [HomeController::class, 'index'])
        ->name('homepage');
});

Route::get('/{slug}', [UserController::class, 'profile'])
    ->name('profile');