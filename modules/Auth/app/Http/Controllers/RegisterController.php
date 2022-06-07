<?php

namespace Modules\Auth\app\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Modules\Auth\app\Actions\RegisterUserAction;
use Modules\Auth\app\Http\Requests\RegisterRequest;

class RegisterController extends BaseController
{

    public function __invoke(RegisterRequest $request)
    {
        (new RegisterUserAction)($request);

        return redirect()->route('homepage');
    }

}