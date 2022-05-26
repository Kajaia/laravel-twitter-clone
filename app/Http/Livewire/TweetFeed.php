<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Follower;
use App\Models\Tweet;
use Livewire\Component;

class TweetFeed extends Component
{
    public $perPage = 10;
    public $feed;
    public $ids;
    public $userId;
    public $category_id;

    protected $queryString = ['category_id'];

    protected $listeners = [
        'createTweet' => 'render',
        'perPageIncrease' => 'render',
        'userFollow' => 'render',
        'deleteTweet' => 'render',
        'deleteCategory' => 'render',
        'userFollow' => 'mount'
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

    public function render()
    {
        return view('livewire.tweet-feed', [
            'categories' => Category::where('user_id', auth()->user()->id)
                ->orderBy('title', 'asc')
                ->get(),
            'tweets' => Tweet::with([
                'user'
            ])
                ->whereIn('user_id', [...$this->ids, $this->userId])
                ->when($this->category_id, function($query) {
                    $query->where('category_id', $this->category_id);
                })
                ->orderBy('created_at', 'desc')
                ->cursorPaginate($this->perPage),
            'tweetsCount' => Tweet::whereIn('user_id', [...$this->ids, $this->userId])
                ->when($this->category_id, function($query) {
                    $query->where('category_id', $this->category_id);
                })->count()
        ]);
    }
}
