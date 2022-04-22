<?php

use App\Http\Controllers\HomeController;
use App\View\Components\CreateTweet;
use App\View\Components\TweetList;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::post('/create-tweet', [CreateTweet::class, 'store'])
    ->name('create.tweet');
Route::post('/reply-tweet', [TweetList::class, 'storeReply'])
    ->name('reply.tweet');