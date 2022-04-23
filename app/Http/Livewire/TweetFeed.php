<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;

class TweetFeed extends Component
{
    public $perPage = 10;

    protected $listeners = [
        'createTweet' => 'render',
        'perPageIncrease' => 'render'
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
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage),
            'tweetsCount' => Tweet::count()
        ]);
    }
}
