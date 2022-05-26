<?php

namespace App\Actions;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UpdateUserAction {

    public function handle(UserUpdateRequest $request, $slug) {
        $user = User::where('slug', $slug)->first();

        $request->file('pic') ? $pic = $request->file('pic')->store('images', 'public') : $pic = $user->pic;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'slug' => Str::slug($request->slug, '-'),
            'pic' => $pic,
            'bio' => $request->bio,
            'visibility' => $request->visibility
        ]);

        return $user;
    }

}