<?php

namespace App\Http\Livewire;

use App\Models\Follower;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class FollowingUsers extends Component
{
    public $userId;

    public $model;

    public $field;

    protected $listeners = [
        'userFollow' => 'render'
    ];

    public function followUserList($user) {
        if(!in_array($this->userId, User::findOrFail($user)->followers->pluck('follower_id')->toArray())) {
            Follower::create([
                'follower_id' => $this->userId,
                'followed_id' => $user
            ]);

            Notification::send(User::find($user), new UserNotification(auth()->user(), auth()->user()->name.' has followed you.'));
        } else {
            Follower::where('follower_id', $this->userId)
                ->where('followed_id', $user)
                ->delete();

            Notification::send(User::find($user), new UserNotification(auth()->user(), auth()->user()->name.' has unfollowed you.'));
        }

        $this->emit('followUserList');
    }

    public function render()
    {
        return view('livewire.following-users', [
            'users' => User::whereHas($this->model, function($query) {
                $query->where($this->field, $this->userId);
            })
                ->get()
        ]);
    }
}
