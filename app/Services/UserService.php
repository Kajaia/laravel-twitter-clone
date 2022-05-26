<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

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

}