<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store(LoginRequest $request)
    {
        try {
            $request->authenticate();
            return response()->json(['Error' => 0]);
        } catch (ValidationException $e) {
            return response()->json([
                'Error' => 1,
                'Message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            Auth::login($user, true);
            return response()->json(['error' => false]);
        }
        else {
            return response()->json(['error' => true, 'Message' => 'This email address is not registered. To continue, you must sign up and complete the verification procedure with this email address.']);
        }
    }
    
    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
