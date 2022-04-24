<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function profile($slug) {
        return view('profile', [
            'user' => User::where('slug', $slug)
                ->get()[0] ?? abort(404)
        ]);
    }

    public function updateProfile(Request $request, $slug) {
        $user = User::where('slug', $slug)
            ->get()[0] ?? abort(404);

        $request->validate([
            'name' => ['required', 'min:5'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'slug' => ['required', Rule::unique('users')->ignore($user->id)],
            'pic' => ['nullable', 'mimes:jpg,jpeg,png,webp,avif', 'max:100'],
            'bio' => ['nullable', 'max:140']
        ]);

        if($request->file('pic')) {
            $pic = $request->file('pic')->store('images', 'public');
        } else {
            $pic = $user->pic;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'slug' => Str::slug($request->slug, '-'),
            'pic' => $pic,
            'bio' => $request->bio,
            'visibility' => $request->visibility
        ]);

        return redirect()
            ->route('profile', [
                Str::slug($request->slug, '-'), 
                'tab' => 'edit'
            ]);
    }
}
