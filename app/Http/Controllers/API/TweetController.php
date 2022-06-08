<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Followers\app\Models\Follower;
use Modules\Likes\app\Services\LikeService;
use Modules\Tweets\app\Http\Requests\TweetRequest;
use Modules\Tweets\app\Http\Resources\TweetResource;
use Modules\Tweets\app\Models\Tweet;
use Modules\Tweets\app\Services\TweetService;

class TweetController extends Controller
{
    protected Request $request;
    protected TweetService $service;

    public function __construct(Request $request, TweetService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    // View user tweet feed
    public function tweets()
    {
        return TweetResource::collection(
            Tweet::whereIn('user_id', [
                ...Follower::where('follower_id', $this->request->user()->id)
                    ->pluck('followed_id')
                    ->toArray(), 
                $this->request->user()->id
                ])->cursorPaginate()
        );
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
    public function like(LikeService $service, $tweet_id) 
    {
        return $service->likeTweet($tweet_id);
    }

    // Dislike tweet
    public function unlike(LikeService $service, $tweet_id) 
    {
        return $service->unlikeTweet($tweet_id);
    }

    // Reply on a tweet
    public function reply($tweet_id) 
    {
        return $this->service->replyTweet($tweet_id, Tweet::findOrFail($tweet_id)->category_id);
    }
}