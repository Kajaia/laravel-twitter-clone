<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile($slug) {
        return view('profile', [
            'user' => User::where('slug', $slug)
                ->get()[0] ?? abort(404)
        ]);
    }
}
