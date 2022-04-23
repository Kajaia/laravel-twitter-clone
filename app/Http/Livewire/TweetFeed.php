<?php

namespace App\Http\Livewire;

use App\Models\Follower;
use App\Models\Tweet;
use Livewire\Component;

class TweetFeed extends Component
{
    public $perPage = 10;

    public $feed;

    public $ids;

    public $userId;

    protected $listeners = [
        'createTweet' => 'render',
        'perPageIncrease' => 'render',
        'userFollow' => 'render',
        'userFollow' => 'mount'
    ];

    public function mount() {
        if($this->feed) {
            $this->ids = Follower::where('follower_id', auth()->user()->id)->pluck('followed_id')->toArray();
        } else {
            $this->ids = [];
        }
    }

    public function perPageIncrease() {
        $this->perPage += 10;
    }

    public function render()
    {
        return view('livewire.tweet-feed', [
            'tweets' => Tweet::with([
                'user'
            ])
                ->whereIn('user_id', $this->ids)
                ->orWhere('user_id', $this->userId)
                ->orderBy('created_at', 'desc')
                ->cursorPaginate($this->perPage),
            'tweetsCount' => Tweet::whereIn('user_id', $this->ids)
                ->orWhere('user_id', $this->userId)
                ->count()
        ]);
    }
}
