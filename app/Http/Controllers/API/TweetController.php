<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Models\Like;
use App\Models\Reply;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function tweets(Request $request) {
        return Tweet::where('user_id', $request->user()->id)->cursorPaginate();
    }

    public function store(TweetRequest $request) {
        $tweet = Tweet::create([
            'content' => $request->content,
            'user_id' => $request->user()->id,
            'category_id' => $request->category_id
        ]);

        return $tweet;
    }

    public function get(Request $request, $tweet_id) {
        return Tweet::where('id', $tweet_id)
                ->where('user_id', $request->user()->id)
                ->first();
    }

    public function replies(Request $request, $tweet_id) {
        return Reply::where('tweet_id', $tweet_id)
                ->whereHas('tweet', function($query) use ($request) {
                    $query->where('user_id', $request->user()->id);
                })->cursorPaginate();
    }

    public function like(Request $request, $tweet_id) {
        if(!in_array($request->user()->id, Tweet::findOrFail($tweet_id)->likes->pluck('user_id')->toArray())) {
            $like = Like::create([
                'tweet_id' => $tweet_id,
                'user_id' => $request->user()->id
            ]);
        } else {
            return response()->json('Already liked!');
        }

        return $like;
    }

    public function unlike(Request $request, $tweet_id) {
        if(in_array($request->user()->id, Tweet::findOrFail($tweet_id)->likes->pluck('user_id')->toArray())) {
            $unlike = Like::where('tweet_id', $tweet_id)
                ->where('user_id', $request->user()->id)
                ->delete();
        } else {
            return response()->json('Can\'t unlike!');
        }

        return response()->json($unlike);
    }

    public function reply(Request $request, $tweet_id) {
        $reply = Reply::create([
            'content' => $request->content,
            'tweet_id' => $tweet_id,
            'user_id' => $request->user()->id
        ]);

        return $reply;
    }
}
