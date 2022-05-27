<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;

class UserReplyFeed extends Component
{
    public $perPage = 10;

    public $userId;

    protected $listeners = [
        'perPageIncrease' => '$refresh',
        'deleteTweet' => '$refresh',
        'deleteReply' => '$refresh'
    ];

    public function perPageIncrease() 
    {
        $this->perPage += 10;
    }

    public function getTweetsProperty()
    {
        return Tweet::with([
                'user'
            ])
                ->whereHas('replies', function($query) {
                    $query->where('user_id', $this->userId);
                })
                ->orderBy('created_at', 'desc')
                ->cursorPaginate($this->perPage);
    }

    public function getTweetsCountProperty()
    {
        return Tweet::whereHas('replies', function($query) {
                $query->where('user_id', $this->userId);
            })->count();
    }

    public function render()
    {
        return view('livewire.user-reply-feed');
    }
}
