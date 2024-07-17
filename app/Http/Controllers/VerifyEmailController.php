<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    public function notVerified() {
        if(Auth::user()->email_verified_at == null)
            return view('email.not-verified');
        else {
           return redirect('/dashboard');
        }
            
    }

    public function verify(EmailVerificationRequest $request) {

        $request->fulfill($request);
        return view('email.verified');
    }
}
