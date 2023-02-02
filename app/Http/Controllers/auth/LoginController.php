<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function view(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        $credentials = $request->except('_token', 'submit');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user) {
                return redirect()->route('tasks');
            } else {
                Auth::logout();
                return back()->with('failed', 'Invalid Login Credentials');
            }
        } else {
            return back()->with('failed', 'Invalid Login Credentials');
        }
    }

}
