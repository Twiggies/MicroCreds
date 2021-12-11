<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'firstname' => ['required', 'max:40'],
            'lastname' => ['required', 'max:40'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'max:20'],
        ]);

        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        return redirect()->route('dashboard');
    }
}
