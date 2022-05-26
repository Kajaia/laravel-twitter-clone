<?php

namespace App\Http\Livewire;

use App\Models\Follower;
use App\Models\Tweet;
use App\Services\UserService;
use Livewire\Component;

class UserProfile extends Component
{
    public $user;

    protected $listeners = [
        'profileUserFollow' => 'render',
        'userFollow' => 'render',
        'followUserList' => 'render'
    ];

    public function profileUserFollow(UserService $service) 
    {
        $service->followUser($this->user);
    }

    public function render()
    {
        return view('livewire.user-profile', [
            'followers' => Follower::where('followed_id', $this->user->id),
            'following' => Follower::where('follower_id', $this->user->id),
            'tweetsCount' => Tweet::where('user_id', $this->user->id)->count()
        ]);
    }
}
