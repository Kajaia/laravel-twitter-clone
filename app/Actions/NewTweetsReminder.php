<?php

namespace App\Actions;

use App\Mail\NewTweetsReminderMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NewTweetsReminder {

    public function __invoke()
    {
        foreach(User::all() as $user) {
            if($user->getFollowingUsersNewTweets()->count()) {
                Mail::to($user->email)
                    ->send(new NewTweetsReminderMail($user, $user->getFollowingUsersNewTweets()));
            }
        }
    }

}