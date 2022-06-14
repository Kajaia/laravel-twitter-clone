<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Categories\app\Services\CategoryService;
use Modules\Favourites\app\Services\FavouriteService;
use Modules\Tweets\app\Models\Tweet;

class UserLikesFeed extends Component
{
    public $perPage = 10;
    public $userId;

    protected $favourite;

    protected $listeners = [
        'perPageIncrease' => '$refresh',
        'deleteTweet' => '$refresh',
        'likeTweet' => '$refresh'
    ];

    public function mount(FavouriteService $favourite)
    {
        $this->favourite = $favourite;
    }

    public function perPageIncrease() 
    {
        $this->perPage += 10;
    }

    public function getTweetsProperty(
        CategoryService $category, 
        FavouriteService $favourite
    )
    {
        $tweets = Tweet::with([
            'user',
            'likes',
            'replies'
        ])
            ->whereHas('likes', function($query) {
                $query->where('user_id', $this->userId);
            })
            ->orderBy('created_at', 'desc')
            ->cursorPaginate($this->perPage);

        $tweets->transform(function($tweet) use ($category, $favourite) {
            $tweet['category'] = $category->getCategoryById($tweet->category_id);
            $tweet['favourites'] = $favourite->getFavouriteByTweetAndUser($tweet->id);

            return $tweet;
        });

        return $tweets;
    }

    public function getTweetsCountProperty()
    {
        return Tweet::whereHas('likes', function($query) {
                $query->where('user_id', $this->userId);
            })->count();
    }

    public function render()
    {
        return view('livewire.user-likes-feed');
    }
}