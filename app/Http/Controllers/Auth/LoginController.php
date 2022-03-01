<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

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

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('usertoken', ['educator'])->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        $request->session()->put('user', $user);
        $request->session()->put('isEducator', true);
        //return $request->session()->all();
        return redirect()->route('dashboard');

    }

    public function student_index() {
        return view('auth.student_login');
    }

    public function student_login(Request $request) {
        $request -> validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'max:20'],
        ]);

        if (!auth()->attempt($request->only('email','password'))) {
            return back()->with('status', 'Invalid Login Credentials');
        }

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('usertoken', ['student'])->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        $request->session()->put('user', $user);
        $request->session()->put('isEducator', false);
        //return $request->session()->all();
        return redirect()->route('student_dashboard');
    }

    public function logout(Request $request) {
        
        auth()->user()->tokens()->delete();
        Session::flush();
        auth()->logout();
        
        return redirect()->route('home');
    }
}
