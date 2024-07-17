<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bills;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if(Auth::user()->role == 1)
            $bills = Bills::get();
        if(Auth::user()->role == 2)
            $bills = Bills::where('userid', Auth::user()->id)->get();

        $users = User::where('role', 2)->count();
        return view('dashboard', ['bills' => $bills, 'users' => $users]);
    }
}
