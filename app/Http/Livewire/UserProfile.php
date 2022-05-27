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
        'profileUserFollow' => '$refresh',
        'userFollow' => '$refresh',
        'followUserList' => '$refresh'
    ];

    public function profileUserFollow(UserService $service) 
    {
        $service->followUser($this->user);
    }

    public function getFollowersProperty()
    {
        return Follower::where('followed_id', $this->user->id);
    }

    public function getFollowingProperty()
    {
        return Follower::where('follower_id', $this->user->id);
    }

    public function getTweetsCountProperty()
    {
        return Tweet::where('user_id', $this->user->id)->count();
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
