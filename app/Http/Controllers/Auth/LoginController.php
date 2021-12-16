<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function store(Request $request) {
        $request -> validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'max:20'],
        ]);

        if (!auth()->attempt($request->only('email','password'))) {
            return back()->with('status', 'Invalid Login Credentials');
        }

        return redirect()->route('dashboard');

    }
}
