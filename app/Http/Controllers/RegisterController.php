<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store(Request $request)
    {

        if(Validator::make($request->all(), [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'location' => ['required', 'max:255'],
            'account_number' => ['required', 'max:255'],
            'phone' => ['required', 'max:11'],
            'role' => ['max:11'],
        ])->fails()) { return response()->json(['Error' => 1, 'Message' => 'Email is already taken']); }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'location' => $request->location,
            'account_number' => $request->account_number,
            'phone' => $request->phone,
            'role' => 2
        ]);
        event(new Registered($user));
        Auth::login($user); 
        
        return response()->json(['Error' => 0]);
    }
}
