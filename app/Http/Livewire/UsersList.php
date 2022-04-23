<?php

namespace App\Http\Livewire;

use App\Models\Follower;
use Livewire\Component;

class UsersList extends Component
{
    public $user;

    public function followUser() {
        if(!in_array(auth()->user()->id, $this->user->followers->pluck('follower_id')->toArray())) {
            Follower::create([
                'follower_id' => auth()->user()->id,
                'followed_id' => $this->user->id
            ]);
        } else {
            Follower::where('follower_id', auth()->user()->id)
                ->where('followed_id', $this->user->id)
                ->delete();
        }

        $this->emit('userFollow');
    }

    public function render()
    {
        return view('livewire.users-list', [
            'followers' => Follower::where('followed_id', $this->user->id)
        ]);
    }
}
