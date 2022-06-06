<?php

namespace App\Services;

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

    // Send notification to the followers when provided user makes a tweet
    public function userTweetedNotification($tweet)
    {
        Notification::send($this->followers()->get(), new UserNotification(auth()->user(), auth()->user()->name.' has tweeted.', $tweet->id));
    }

    // Check if provided user is author of this tweet
    public function isAuthor($userId) 
    {
        return $userId === auth()->user()->id;
    }

}