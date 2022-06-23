<?php

namespace Modules\Auth\app\Actions;

use App\Models\User;
use Illuminate\Support\Str;
use App\Events\UserRegistered;
use Modules\Auth\app\Http\Requests\RegisterRequest;

class RegisterUserAction
{

    public function __invoke(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'slug' => Str::slug($request->name, '-')
        ]);

        event(new UserRegistered($user));

        auth()->login($user);
    }

}