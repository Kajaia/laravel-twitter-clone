<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    // Verify email
    public function verify(EmailVerificationRequest $request) 
    {
        $request->fulfill();
 
        return redirect('/')->with('message', 'Email verified successfully!');
    }

    // Resend email verification link
    public function resend(Request $request) 
    {
        $request->user()->sendEmailVerificationNotification();
 
        return back()->with('message', 'Verification link sent!');
    }
}
