<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(Request $request) {
        return ['data' => User::findOrFail($request->user()->id)];
    }

    public function following(Request $request) {
        return [
            'data' => User::whereHas('followers', function($query) use ($request) {
                $query->where('follower_id', $request->user()->id);
            })->get()
        ];
    }

    public function followers(Request $request) {
        return [
            'data' => User::whereHas('following', function($query) use ($request) {
                $query->where('followed_id', $request->user()->id);
            })->get()
        ];
    }
}
