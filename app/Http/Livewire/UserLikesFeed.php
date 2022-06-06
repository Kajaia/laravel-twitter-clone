<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Tweets\app\Models\Tweet;

class UserLikesFeed extends Component
{
    public $perPage = 10;

    public $userId;

    protected $listeners = [
        'perPageIncrease' => '$refresh',
        'deleteTweet' => '$refresh',
        'likeTweet' => '$refresh'
    ];

    public function perPageIncrease() 
    {
        $this->perPage += 10;
    }

    public function getTweetsProperty()
    {
        return Tweet::with([
                'user',
                'category',
                'likes',
                'replies',
                'favourites'
            ])
                ->whereHas('likes', function($query) {
                    $query->where('user_id', $this->userId);
                })
                ->orderBy('created_at', 'desc')
                ->cursorPaginate($this->perPage);
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