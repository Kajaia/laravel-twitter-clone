<?php

namespace App\Http\Controllers;

use Modules\Categories\app\Services\CategoryService;
use Modules\Favourites\app\Services\FavouriteService;
use Modules\Tweets\app\Services\TweetService;

class TweetController extends Controller
{
    // Get tweet by id
    public function __invoke(
        CategoryService $category, 
        TweetService $tweetService, 
        FavouriteService $favourite, 
        $id
    )
    {
        $tweet = $tweetService->getTweetById($id);

        $tweet['category'] = $category->getCategoryById($tweet->category_id);
        $tweet['favourites'] = $favourite->getFavouriteByTweetAndUser($tweet->id);

        return view('tweet', ['tweet' => $tweet]);
    }
}