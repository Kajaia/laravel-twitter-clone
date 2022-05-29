<?php

namespace App\Actions;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UpdateUserAction {

    // Update user profile details
    public function handle(UserUpdateRequest $request, $slug) 
    {
        $user = User::where('slug', $slug)->first();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password 
                ? Hash::make($request->password) 
                : $user->password,
            'slug' => Str::slug($request->slug, '-'),
            'pic' => $request->file('pic') 
                ? $request->file('pic')->store('images', 'public') 
                : $user->pic,
            'bio' => $request->bio,
            'visibility' => $request->visibility
        ]);

        return $user;
    }

}