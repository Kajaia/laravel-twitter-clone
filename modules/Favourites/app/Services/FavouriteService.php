<?php

namespace Modules\Favourites\app\Services;

use Modules\Tweets\app\Models\Tweet;
use Modules\Favourites\app\Models\Favourite;

class FavouriteService
{

    // Check if user has already saved provided tweet on his/her favourites list
    public function isFavourited(Tweet $tweet)
    {
        return in_array(auth()->user()->id, $tweet->favourites->pluck('user_id')->toArray());
    }

    // Save tweet to the favourites list
    public function addFavourites(Tweet $tweet)
    {
        if(!$this->isFavourited($tweet)) {
            Favourite::create([
                'tweet_id' => $tweet->id,
                'user_id' => auth()->user()->id
            ]);
        } else {
            Favourite::where('tweet_id', $tweet->id)
                ->where('user_id', auth()->user()->id)
                ->delete();
        }
    }

}