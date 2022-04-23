<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;

class TweetFeed extends Component
{
    protected $listeners = [
        'createTweet' => 'render'
    ];

    public function render()
    {
        return view('livewire.tweet-feed', [
            'tweets' => Tweet::with([
                'user'
            ])
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        ]);
    }
}
