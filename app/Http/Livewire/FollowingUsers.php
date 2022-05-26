<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Services\UserService;
use Livewire\Component;

class FollowingUsers extends Component
{
    public $userId;
    public $model;
    public $field;

    protected $listeners = [
        'userFollow' => 'render'
    ];

    public function followUserList(UserService $service, User $user) 
    {
        $service->followUser($user);

        $this->emit('followUserList');
    }

    public function render()
    {
        return view('livewire.following-users', [
            'users' => User::whereHas($this->model, function($query) {
                $query->where($this->field, $this->userId);
            })->get()
        ]);
    }
}
