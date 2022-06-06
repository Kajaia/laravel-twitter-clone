<?php

namespace Modules\Followers\app\Services;

use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;
use Modules\Followers\app\Models\Follower;

class FollowerService
{

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

}