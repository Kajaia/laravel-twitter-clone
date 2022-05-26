<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(Request $request) {
        return User::findOrFail($request->user()->id);
    }

    public function following(Request $request, UserService $service) {
        return $service->following($request)->cursorPaginate();
    }

    public function follows(Request $request, UserService $service) {
        return $service->followers($request)->cursorPaginate();
    }
}
