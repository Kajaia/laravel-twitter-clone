<?php

namespace App\Http\Livewire;

use App\Models\Follower;
use App\Models\Tweet;
use Livewire\Component;

class TweetFeed extends Component
{
    public $perPage = 10;

    protected $listeners = [
        'createTweet' => 'render',
        'perPageIncrease' => 'render',
        'userFollow' => 'render'
    ];

    public function perPageIncrease() {
        $this->perPage += 10;

        $this->emit('perPageIncrease');
    }

    public function render()
    {
        return view('livewire.tweet-feed', [
            'tweets' => Tweet::with([
                'user'
            ])
                ->whereIn('user_id', Follower::where('follower_id', auth()->user()->id)->pluck('followed_id')->toArray())
                ->orWhere('user_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage),
            'tweetsCount' => Tweet::whereIn('user_id', Follower::where('follower_id', auth()->user()->id)->pluck('followed_id')->toArray())
                ->orWhere('user_id', auth()->user()->id)
                ->count()
        ]);
    }
}
