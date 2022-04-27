<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Reply;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function tweets(Request $request) {
        return [
            'data' => Tweet::where('user_id', $request->user()->id)
                ->get()
        ];
    }

    public function createTweet(Request $request) {
        $request->validate([
            'content' => ['required', 'max:140']
        ]);

        $tweet = Tweet::create([
            'content' => $request->content,
            'user_id' => $request->user()->id
        ]);

        return [
            'data' => $tweet
        ];
    }

    public function getTweet(Request $request, $tweet_id) {
        return [
            'data' => Tweet::where('id', $tweet_id)
                ->where('user_id', $request->user()->id)
                ->get()[0] ?? abort(404)
        ];
    }

    public function tweetReplies(Request $request, $tweet_id) {
        $userId = $request->user()->id;

        return [
            'data' => Reply::where('tweet_id', $tweet_id)
                ->whereHas('tweet', function($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
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
            'user_id' => $request->user()->id
        ]);

        return [
            'data' => $reply
        ];
    }

    public function likeTweet(Request $request, $tweet_id) {
        if(!in_array($request->user()->id, Tweet::findOrFail($tweet_id)->likes->pluck('user_id')->toArray())) {
            $like = Like::create([
                'tweet_id' => $tweet_id,
                'user_id' => $request->user()->id
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

    public function unlikeTweet(Request $request, $tweet_id) {
        if(in_array($request->user()->id, Tweet::findOrFail($tweet_id)->likes->pluck('user_id')->toArray())) {
            Like::where('tweet_id', $tweet_id)
                ->where('user_id', $request->user()->id)
                ->delete();
        }
    }
}
