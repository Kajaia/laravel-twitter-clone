<?php

namespace App\Http\Controllers;

use App\Actions\UpdateUserAction;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function profile($slug) {
        return view('profile', [
            'user' => User::where('slug', $slug)->first()
        ]);
    }

    public function update(UserUpdateRequest $request, UpdateUserAction $action, $slug) {
        $action->handle($request, $slug);

        return redirect()
            ->route('profile', [Str::slug($request->slug, '-'), 'tab' => 'edit']);
    }
}
