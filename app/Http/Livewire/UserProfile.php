<?php

namespace App\Http\Livewire;

use App\Models\Follower;
use App\Models\Tweet;
use Livewire\Component;

class UserProfile extends Component
{
    public $user;

    protected $listeners = [
        'profileUserFollow' => 'render',
        'userFollow' => 'render',
        'followUserList' => 'render'
    ];

    public function profileUserFollow() {
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
    }

    public function render()
    {
        return view('livewire.user-profile', [
            'followers' => Follower::where('followed_id', $this->user->id),
            'following' => Follower::where('follower_id', $this->user->id),
            'tweetsCount' => Tweet::where('user_id', $this->user->id)
                ->count()
        ]);
    }
}
