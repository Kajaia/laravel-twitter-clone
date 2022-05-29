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

    // Get users that are followed by provided user
    public function following() 
    {
        return User::whereHas('followers', function($query) {
            $query->where('follower_id', $this->request->user()->id);
        });
    }

    // Get followers of the provided user
    public function followers() 
    {
        return User::whereHas('following', function($query) {
            $query->where('followed_id', $this->request->user()->id);
        }); 
    }

    // Check if auth user already followed provided user
    public function isFollowed(User $user)
    {
        return in_array(auth()->user()->id, $user->followers->pluck('follower_id')->toArray());
    }

    // Send notification to the user if someone follows/unfollows him/her
    public function followUserNotification(User $user, $str)
    {
        Notification::send($user, new UserNotification(auth()->user(), auth()->user()->name.' has ' . $str . ' you.', null));
    }

    // Send notification to the followers when provided user makes a tweet
    public function userTweetedNotification($tweet)
    {
        Notification::send($this->followers()->get(), new UserNotification(auth()->user(), auth()->user()->name.' has tweeted.', $tweet->id));
    }

    // Follow or unfollow a user
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