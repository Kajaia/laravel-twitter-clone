<?php

namespace Modules\Favourites\app\Services;

use Modules\Favourites\app\Models\Favourite;

class FavouriteService
{

    // Check if user has already saved provided tweet on his/her favourites list
    public function isFavourited($tweetId)
    {
        return in_array(auth()->user()->id, Favourite::where('tweet_id', $tweetId)->pluck('user_id')->toArray());
    }

    // Save tweet to the favourites list
    public function addFavourites($tweetId)
    {
        if(!$this->isFavourited($tweetId)) {
            Favourite::create([
                'tweet_id' => $tweetId,
                'user_id' => auth()->user()->id
            ]);
        } else {
            Favourite::where('tweet_id', $tweetId)
                ->where('user_id', auth()->user()->id)
                ->delete();
        }
    }

    public function getFavouriteByTweet($tweetId)
    {
        return Favourite::where('tweet_id', $tweetId)->get();
    }

    public function getFavouriteByUser($userId)
    {
        return Favourite::where('user_id', $userId)->pluck('tweet_id')->toArray();
    }

    public function getFavouriteByTweetAndUser($tweetId)
    {
        return Favourite::where([
            'tweet_id' => $tweetId,
            'user_id' => auth()->user()->id
        ])->get();
    }

}