<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Livewire\Component;

class UsersList extends Component
{
    public $user;

    public function followUser(UserService $service) 
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
