<?php

namespace Modules\Auth\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Modules\Auth\app\Actions\LogoutUserAction;

class LogoutController extends BaseController
{

    public function __invoke(Request $request)
    {
        (new LogoutUserAction)($request);

        return redirect()->route('login');
    }

}