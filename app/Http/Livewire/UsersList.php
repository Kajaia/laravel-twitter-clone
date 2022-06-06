<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Followers\app\Services\FollowerService;

class UsersList extends Component
{
    public $user;

    public function followUser(FollowerService $service) 
    {
        $service->followUser($this->user);

        $this->user = $this->user->refresh();

        $this->emit('userFollow');
    }

    public function render()
    {
        return view('livewire.users-list');
    }
}