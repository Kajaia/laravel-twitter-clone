<?php

use App\Models\Follower;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Reply;
use App\Models\Tweet;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', function() {
    return [
        'users' => User::with([
            'tweets',
            'replies',
            'likes',
            'notifications',
            'followers',
            'following'
        ])
            ->paginate()
    ];
});

Route::get('/tweets', function() {
    return [
        'tweets' => Tweet::with([
            'user',
            'replies',
            'likes'
        ])
            ->paginate()
    ];
});

Route::get('/replies', function() {
    return [
        'replies' => Reply::with([
            'tweet',
            'user'
        ])
            ->paginate()
    ];
});

Route::get('/likes', function() {
    return [
        'likes' => Like::with([
            'tweet',
            'user'
        ])
            ->paginate()
    ];
});

Route::get('/notifications', function() {
    return [
        'notifications' => Notification::with([
            'sender',
            'receiver'
        ])
            ->paginate()
    ];
});

Route::get('/followers', function() {
    return [
        'followers' => Follower::with([
            'follower',
            'following'
        ])
            ->paginate()
    ];
});