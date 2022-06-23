<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Tweets\app\Models\Tweet;
use Modules\Followers\app\Models\Follower;
use Modules\Likes\app\Services\LikeService;
use Modules\Categories\app\Services\CategoryService;
use Modules\Favourites\app\Services\FavouriteService;

class TweetFeed extends Component
{
    public $perPage = 10;
    public $feed;
    public $ids;
    public $userId;
    public $category_id;

    protected $queryString = ['category_id'];

    protected $listeners = [
        'createTweet' => '$refresh',
        'perPageIncrease' => '$refresh',
        'deleteTweet' => '$refresh',
        'deleteCategory' => '$refresh',
        'userFollow' => '$refresh'
    ];

    public function mount() 
    {
        if($this->feed) {
            $this->ids = Follower::where('follower_id', auth()->user()->id)->pluck('followed_id')->toArray();
        } else {
            $this->ids = [];
        }
    }

    public function perPageIncrease() 
    {
        $this->perPage += 10;
    }

    public function getCategoriesProperty(CategoryService $category)
    {
        if($this->feed) {
            return $category->getCategoriesByUser(auth()->user()->id ?? null);
        } else {
            return $category->getCategoriesByUser($this->userId);
        }
    }

    public function getTweetsProperty(
        CategoryService $category, 
        FavouriteService $favourite,
        LikeService $like,
    )
    {
        $tweets = Tweet::with([
            'user'
        ])
            ->whereIn('user_id', [...$this->ids, $this->userId])
            ->when($this->category_id, function($query) {
                $query->where('category_id', $this->category_id);
            })
            ->orderBy('created_at', 'desc')
            ->cursorPaginate($this->perPage);

        $tweets->transform(function($tweet) use ($category, $favourite, $like) {
            $tweet['category'] = $category->getCategoryById($tweet->category_id);
            $tweet['favourites'] = $favourite->getFavouriteByTweetAndUser($tweet->id);
            $tweet['likes'] = $like->getLikeByTweetAndUser($tweet->id);

            return $tweet;
        });

        return $tweets;
    }

    public function getTweetsCountProperty()
    {
        return Tweet::whereIn('user_id', [...$this->ids, $this->userId])
            ->when($this->category_id, function($query) {
                $query->where('category_id', $this->category_id);
            })->count();
    }

    public function render()
    {
        return view('livewire.tweet-feed');
    }
}