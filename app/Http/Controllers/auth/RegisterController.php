<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function view() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:5']
        ]);

        $is_user_created = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        if($is_user_created) {
            return back()->with('success', 'Magic has been spelled');
        } else {
            return back()->with('failed', 'Magic has failed to spell');
        }
    }
};

