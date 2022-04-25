<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public $userId = 101;

    public function me() {
        return [
            'data' => User::findOrFail($this->userId)
        ];
    }

    public function following() {
        return [
            'data' => User::whereHas('followers', function($query) {
                $query->where('follower_id', $this->userId);
            })->get()
        ];
    }

    public function followers() {
        return [
            'data' => User::whereHas('following', function($query) {
                $query->where('followed_id', $this->userId);
            })->get()
        ];
    }
}
