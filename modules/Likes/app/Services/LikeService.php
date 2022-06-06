<?php

namespace Modules\Likes\app\Services;

use Illuminate\Http\Request;
use App\Services\UserService;
use Modules\Likes\app\Models\Like;
use Modules\Tweets\app\Models\Tweet;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

class LikeService
{

    protected Request $request;
    protected UserService $user;

    public function __construct(Request $request, UserService $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    // Check if tweet is liked by this user
    public function isLiked($userId, $tweet_id) 
    {
        return in_array($userId, Tweet::findOrFail($tweet_id)->likes->pluck('user_id')->toArray());
    }

    // Like a tweet
    public function likeTweet($tweet_id) 
    {
        if(!$this->isLiked($this->request->user()->id, $tweet_id)) {
            $like = Like::create([
                'tweet_id' => $tweet_id,
                'user_id' => $this->request->user()->id
            ]);
        } else {
            return response()->json('Already liked!');
        }

        return $like;
    }

    // Dislike a tweet
    public function unlikeTweet($tweet_id) 
    {
        if($this->isLiked($this->request->user()->id, $tweet_id)) {
            $unlike = Like::where('tweet_id', $tweet_id)
                ->where('user_id', $this->request->user()->id)
                ->delete();
        } else {
            return response()->json('Can\'t unlike!');
        }

        return response()->json($unlike);
    }

    // Like or dislike a tweet
    public function likeUnlikeTweet(Tweet $tweet)
    {
        if(!$this->isLiked(auth()->user()->id, $tweet->id)) {
            Like::create([
                'tweet_id' => $tweet->id,
                'user_id' => auth()->user()->id
            ]);

            if(!$this->user->isAuthor($tweet->user_id)) {
                $this->likeTweetNotification($tweet, 'liked');
            }
        } else {
            Like::where('tweet_id', $tweet->id)
                ->where('user_id', auth()->user()->id)
                ->delete();

            if(!$this->user->isAuthor($tweet->user_id)) {
                $this->likeTweetNotification($tweet, 'unliked');
            }
        }
    }

    // Send notification to a tweet author that someone liked his/her tweet
    public function likeTweetNotification(Tweet $tweet, $str)
    {
        Notification::send($tweet->user, new UserNotification(auth()->user(), auth()->user()->name . ' ' . $str . ' your tweet.', $tweet->id));
    }

}