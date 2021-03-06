<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index() {
        return view('auth.educator_register');
    }

    public function student_index() {
        return view('auth.student_register');
    }
    public function store(Request $request) {
        $request->validate([
            'firstname' => ['required', 'max:40'],
            'lastname' => ['required', 'max:40'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'max:20'],
        ]);

        if (User::where('email', $request->email)->first()) {
            return back()->with('status', 'Email has been registered');
        }
        
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'educator',
        ]);
        
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        
        $request->session()->put('user', $user);
        $request->session()->put('isEducator', true);
        return redirect()->route('dashboard');
    }

    public function studentreg(Request $request) {
        $request->validate([
            'firstname' => ['required', 'max:40'],
            'lastname' => ['required', 'max:40'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'max:20'],
        ]);

        if (User::where('email', $request->email)->first()) {
            return back()->with('status', 'Email has been registered');
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'student',
        ]);

        $token = $user->createToken('usertoken', ['student'])->plainTextToken;
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $response = [
            'user' => $user,
            'token' => $token
        ];
        //return response()
        $request->session()->put('user', $user);
        $request->session()->put('isEducator', false);
        return redirect()->route('student_dashboard');
    }
}
