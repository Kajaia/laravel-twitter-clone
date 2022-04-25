<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Reply;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public $userId = 101;

    public function tweets() {
        return [
            'data' => Tweet::where('user_id', $this->userId)
                ->get()
        ];
    }

    public function createTweet(Request $request) {
        $request->validate([
            'content' => ['required', 'max:140']
        ]);

        $tweet = Tweet::create([
            'content' => $request->content,
            'user_id' => $this->userId
        ]);

        return [
            'data' => $tweet
        ];
    }

    public function getTweet($tweet_id) {
        return [
            'data' => Tweet::where('id', $tweet_id)
                ->where('user_id', $this->userId)
                ->get()[0] ?? abort(404)
        ];
    }

    public function tweetReplies($tweet_id) {
        return [
            'data' => Reply::where('tweet_id', $tweet_id)
                ->get()
        ];
    }

    public function replyTweet(Request $request, $tweet_id) {
        $request->validate([
            'content' => ['required', 'max:280']
        ]);

        $reply = Reply::create([
            'content' => $request->content,
            'tweet_id' => $tweet_id,
            'user_id' => $this->userId
        ]);

        return [
            'data' => $reply
        ];
    }

    public function likeTweet($tweet_id) {
        if(!in_array($this->userId, Tweet::findOrFail($tweet_id)->likes->pluck('user_id')->toArray())) {
            $like = Like::create([
                'tweet_id' => $tweet_id,
                'user_id' => $this->userId
            ]);
        } else {
            return [
                'status' => 'Already liked!'
            ];
        }

        return [
            'data' => $like
        ];
    }

    public function unlikeTweet($tweet_id) {
        if(in_array($this->userId, Tweet::findOrFail($tweet_id)->likes->pluck('user_id')->toArray())) {
            Like::where('tweet_id', $tweet_id)
                ->where('user_id', $this->userId)
                ->delete();
        }
    }
}
