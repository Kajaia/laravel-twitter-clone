<?php

namespace App\Actions;

use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

class SendAggregatedInformation {

    public function __invoke()
    {
        foreach(User::all() as $user) {
            Notification::send($user, new UserNotification($user, 'For the past 1 week you followed ' . $user->getFollowingUsersCount() . ' users, ' . $user->getFollowersCount() . ' users followed you.', null));
        }
    }

}