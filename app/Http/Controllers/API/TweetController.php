<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function tweets(Request $request) {
        return Tweet::where('user_id', $request->user()->id)->cursorPaginate();
    }

    public function store(TweetRequest $request, TweetService $service) {
        return $service->createTweet($request);
    }

    public function get(Request $request, TweetService $service, $tweet_id) {
        return $service->getUserTweet($request, $tweet_id);
    }

    public function replies(Request $request, TweetService $service, $tweet_id) {
        return $service->getTweetReplies($request, $tweet_id)->cursorPaginate();
    }

    public function like(Request $request, TweetService $service, $tweet_id) {
        return $service->likeTweet($request, $tweet_id);
    }

    public function unlike(Request $request, TweetService $service, $tweet_id) {
        return $service->unlikeTweet($request, $tweet_id);
    }

    public function reply(Request $request, TweetService $service, $tweet_id) {
        return $service->replyTweet($request, $tweet_id);
    }
}
