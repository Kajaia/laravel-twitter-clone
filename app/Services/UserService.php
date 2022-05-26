<?php

namespace App\Services;

use App\Models\Follower;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class UserService {

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function following() 
    {
        return User::whereHas('followers', function($query) {
            $query->where('follower_id', $this->request->user()->id);
        });
    }

    public function followers() 
    {
        return User::whereHas('following', function($query) {
            $query->where('followed_id', $this->request->user()->id);
        }); 
    }

    public function isFollowed(User $user)
    {
        return in_array(auth()->user()->id, $user->followers->pluck('follower_id')->toArray());
    }

    public function followUserNotification(User $user, $str)
    {
        Notification::send($user, new UserNotification(auth()->user(), auth()->user()->name.' has ' . $str . ' you.', null));
    }

    public function userTweetedNotification($tweet)
    {
        Notification::send($this->followers()->get(), new UserNotification(auth()->user(), auth()->user()->name.' has tweeted.', $tweet->id));
    }

    public function followUser(User $user)
    {
        if(!$this->isFollowed($user)) {
            Follower::create([
                'follower_id' => auth()->user()->id,
                'followed_id' => $user->id
            ]);

            $this->followUserNotification($user, 'followed');
        } else {
            Follower::where('follower_id', auth()->user()->id)
                ->where('followed_id', $user->id)
                ->delete();

            $this->followUserNotification($user, 'unfollowed');
        }
    }

}