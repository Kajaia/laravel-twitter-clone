<?php

namespace Modules\Auth\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Modules\Auth\app\Actions\LoginUserAction;

class LoginController extends BaseController
{

    public function __invoke(Request $request)
    {
        (new LoginUserAction)($request);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

}