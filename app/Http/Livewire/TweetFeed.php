<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Categories\app\Models\Category;
use Modules\Followers\app\Models\Follower;
use Modules\Tweets\app\Models\Tweet;

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

    public function getCategoriesProperty()
    {
        return Category::where('user_id', auth()->user()->id ?? null)
            ->orderBy('title', 'asc')
            ->get();
    }

    public function getTweetsProperty()
    {
        return Tweet::with([
                'user',
                'category',
                'likes',
                'favourites'
            ])
                ->whereIn('user_id', [...$this->ids, $this->userId])
                ->when($this->category_id, function($query) {
                    $query->where('category_id', $this->category_id);
                })
                ->orderBy('created_at', 'desc')
                ->cursorPaginate($this->perPage);
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