<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Followers\app\Services\FollowerService;

class UserProfile extends Component
{
    public $user;

    protected $listeners = [
        'profileUserFollow' => '$refresh',
        'userFollow' => '$refresh',
        'followUserList' => '$refresh'
    ];

    public function profileUserFollow(FollowerService $service) 
    {
        $service->followUser($this->user);

        $this->user = $this->user->refresh();
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}