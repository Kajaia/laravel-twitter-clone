<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService {

    public function following(Request $request) {
        return User::whereHas('followers', function($query) use ($request) {
            $query->where('follower_id', $request->user()->id);
        });
    }

    public function followers(Request $request) {
        return User::whereHas('following', function($query) use ($request) {
            $query->where('followed_id', $request->user()->id);
        }); 
    }

}