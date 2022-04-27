<?php

use App\Http\Controllers\API\TweetController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// REST API endpoints
Route::prefix('v1')->middleware('auth:sanctum')->group(function() {
    // User details
    Route::get('/me', [UserController::class, 'me']);
    Route::get('/me/following', [UserController::class, 'following']);
    Route::get('/me/follows', [UserController::class, 'followers']);

    // Tweets, replies and likes
    Route::get('/tweets', [TweetController::class, 'tweets']);
    Route::post('/tweets', [TweetController::class, 'createTweet']);
    Route::get('/tweets/{tweet_id}', [TweetController::class, 'getTweet']);
    Route::get('/tweets/{tweet_id}/replies', [TweetController::class, 'tweetReplies']);
    Route::post('/tweets/{tweet_id}/like', [TweetController::class, 'likeTweet']);
    Route::delete('/tweets/{tweet_id}/unlike', [TweetController::class, 'unlikeTweet']);
    Route::post('/tweets/{tweet_id}/reply', [TweetController::class, 'replyTweet']);
});