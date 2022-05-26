<?php

namespace App\Http\Controllers;

use App\Actions\UpdateUserAction;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected UpdateUserAction $action;

    public function __construct(UpdateUserAction $action)
    {
        $this->action = $action;
    }

    public function profile($slug) 
    {
        return view('profile', [
            'user' => User::where('slug', $slug)->first()
        ]);
    }

    public function update(UserUpdateRequest $request, $slug) 
    {
        $this->action->handle($request, $slug);

        return redirect()
            ->route('profile', [Str::slug($request->slug, '-'), 'tab' => 'edit']);
    }
}
