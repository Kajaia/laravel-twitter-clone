<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    protected Request $request;
    protected TweetService $service;

    public function __construct(Request $request, TweetService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    // View user tweets
    public function tweets()
    {
        return TweetResource::collection(Tweet::where('user_id', $this->request->user()->id)->cursorPaginate());
    }

    // Make a tweet
    public function store(TweetRequest $request)
    {
        return new TweetResource($this->service->createTweet($request));
    }

    // Get auth user tweet by id
    public function get($tweet_id) 
    {
        return new TweetResource($this->service->getUserTweet($tweet_id));
    }

    // Get tweet replies
    public function replies($tweet_id) 
    {
        return $this->service->getTweetReplies($tweet_id)->cursorPaginate();
    }

    // Like tweet
    public function like($tweet_id) 
    {
        return $this->service->likeTweet($tweet_id);
    }

    // Dislike tweet
    public function unlike($tweet_id) 
    {
        return $this->service->unlikeTweet($tweet_id);
    }

    // Reply on a tweet
    public function reply($tweet_id) 
    {
        return $this->service->replyTweet($tweet_id);
    }
}
