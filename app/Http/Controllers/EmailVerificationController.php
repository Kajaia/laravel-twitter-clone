<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verify(EmailVerificationRequest $request) 
    {
        $request->fulfill();
 
        return redirect('/')->with('message', 'Email verified successfully!');
    }

    public function notice() 
    {
        return view('auth.verify');
    }

    public function resend(Request $request) 
    {
        $request->user()->sendEmailVerificationNotification();
 
        return back()->with('message', 'Verification link sent!');
    }
}
