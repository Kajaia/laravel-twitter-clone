<?php

namespace Modules\Tweets\app\Services;

use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Modules\Tweets\app\Http\Requests\TweetRequest;
use Modules\Tweets\app\Models\Tweet;

class TweetService {

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // Create tweet
    public function createTweet(TweetRequest $request) 
    {
        $tweet = Tweet::create([
            'content' => $request->content,
            'user_id' => $request->user()->id,
            'category_id' => $request->category_id
        ]);

        return $tweet;
    }

    // Get specific user tweet by id
    public function getUserTweet($tweet_id) 
    {
        return Tweet::where('id', $tweet_id)->first();
    }

    // Get specific tweet replies
    public function getTweetReplies($tweet_id) 
    {
        return Tweet::where('tweet_id', $tweet_id);
    }

    // Reply on a tweet
    public function replyTweet($tweet_id, $category_id) 
    {
        $reply = Tweet::create([
            'content' => $this->request->content,
            'tweet_id' => $tweet_id,
            'category_id' => $category_id,
            'user_id' => $this->request->user()->id
        ]);

        return $reply;
    }

    // Send notification to a tweet author that someone replied on his/her tweet
    public function replyOnTweetNotification(Tweet $tweet)
    {
        Notification::send($tweet->user, new UserNotification(auth()->user(), auth()->user()->name.' replied to your tweet.', $tweet->id));
    }

}