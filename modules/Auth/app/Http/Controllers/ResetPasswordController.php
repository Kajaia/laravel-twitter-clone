<?php

namespace Modules\Auth\app\Http\Controllers;

use Illuminate\Support\Facades\Password;
use Illuminate\Routing\Controller as BaseController;
use Modules\Auth\app\Actions\UpdatePasswordAction;
use Modules\Auth\app\Http\Requests\ResetRequest;
use Modules\Auth\app\Http\Requests\UpdatePasswordRequest;

class ResetPasswordController extends BaseController
{

    public function reset(ResetRequest $request)
    {
        $status = Password::sendResetLink($request->only('email'));
     
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['message' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function token($token)
    {
        return view('auth::reset-password', ['token' => $token]);
    }

    public function update(UpdatePasswordRequest $request)
    {
        $status = (new UpdatePasswordAction)($request);
        
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('message', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

}