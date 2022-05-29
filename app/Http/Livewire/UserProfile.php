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

        $this->user = $this->user->refresh();
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
