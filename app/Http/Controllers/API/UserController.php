<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected Request $request;
    protected UserService $service;

    public function __construct(Request $request, UserService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    public function me() 
    {
        return User::findOrFail($this->request->user()->id);
    }

    public function following() 
    {
        return $this->service->following($this->request)->cursorPaginate();
    }

    public function follows() 
    {
        return $this->service->followers($this->request)->cursorPaginate();
    }
}
