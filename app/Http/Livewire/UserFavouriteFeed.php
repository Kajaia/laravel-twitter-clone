<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;

class UserFavouriteFeed extends Component
{
    public $perPage = 10;

    public $userId;

    protected $listeners = [
        'perPageIncrease' => 'render',
        'deleteTweet' => 'render',
        'addToFavourites' => 'render'
    ];

    public function perPageIncrease() {
        $this->perPage += 10;
    }

    public function render()
    {
        return view('livewire.user-favourite-feed', [
            'tweets' => Tweet::with([
                'user'
            ])
                ->whereHas('favourites', function($query) {
                    $query->where('user_id', $this->userId);
                })
                ->orderBy('created_at', 'desc')
                ->cursorPaginate($this->perPage),
            'tweetsCount' => Tweet::whereHas('favourites', function($query) {
                $query->where('user_id', $this->userId);
            })
                ->count()
        ]);
    }
}
