<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Modules\Followers\app\Services\FollowerService;

class FollowingUsers extends Component
{
    public $userId;
    public $model;
    public $field;

    protected $listeners = [
        'userFollow' => '$refresh'
    ];

    public function followUserList(FollowerService $service, User $user) 
    {
        $service->followUser($user);

        $this->emit('followUserList');
    }

    public function getUsersProperty()
    {
        return User::whereHas($this->model, function($query) {
                $query->where($this->field, $this->userId);
            })->get();
    }

    public function render()
    {
        return view('livewire.following-users');
    }
}