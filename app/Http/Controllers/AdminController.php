<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function __construct() 
    {
        $this->middleware('adminauth')->except(['index', 'login']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        return view('admin.login');
    }

    public function dashboard() {
        return view('admin.admin_dashboard');
    }

    public function login(Request $request) {
        
        $request -> validate([
            'username' => ['required', 'max:20'],
            'password' => ['required', 'max:20'],
        ]);
        
        if (!Auth::guard('admin')->attempt($request->only('username','password'))) {
            return back()->with('status', 'Invalid Login Credentials');
        }
        
        $admin = Admin::where('username', $request->username)->first();
        $request->session()->put('admin', $admin);
        $request->session()->put('isAdmin', true);
        
        return redirect()->route('admin_dashboard');
    }

    public function admins(Request $request) {
        $admins = Admin::all();
        return view('admin.admin_list', compact('admins'));
    }

    public function educators(Request $request) {
        $educators = User::where('type', 'educator')->get();
        return view('admin.educator_list', compact('educators'));
    }

    public function students(Request $request) {
        $students = User::where('type', 'student')->get();
        return view('admin.student_list', compact('students'));
    }

    public function editeducator(Request $request) {
        $educator = User::find($request->user_id);
        $profile = Profile::where('user_id', $request->user_id)->first();
        if (!$profile) {
            $request->session()->now('message', 'This user has not set up their profile yet. Therefore only their name and email are available.');
            $request->session()->now('message-type', 'bg-red-400');
        }
        return view('admin.edit_educator', compact('profile','educator'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    public function pending(Request $request) {
        $courses = Course::where('status', 'inactive')->get();
        return view('admin.course_list', compact('courses'));
    }

    public function coursedetails(Request $request) {
        $course = Course::find($request->course_id);
        return view('admin.course_details', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $request->validate([
            'firstname' => ['required', 'max:40'],
            'lastname' => ['required', 'max:40'],
            'username' => ['required', 'max:20'],
            'password' => ['required', 'max:20'],
        ]);
        
        
        if (Admin::where('username', $request->username)->first()) {
            return back()->with('status', 'Username has already been in use.');
        }
        $admin =Admin::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        
         Auth::guard('admin')->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ]);
        $request->session()->put('admin', $admin);
        $request->session()->put('isAdmin', true);

        return redirect()->route('admin_dashboard');
    }

    public function ajaxStore(Request $request) {
        $request->validate([
            'firstname' => ['required', 'max:40'],
            'lastname' => ['required', 'max:40'],
            'username' => ['required', 'max:20'],
            'password' => ['required', 'max:20'],
        ]);
        
        
        if (Admin::where('username', $request->username)->first()) {
            $request->session()->flash('message', 'Username has already been in use');
            $request->session()->flash('message-type', 'bg-red-400');
    
            return response()->json(['status' => 'Username has already been in use.']);
        }
        $admin =Admin::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        $request->session()->flash('message', 'New admin added successfully.');
        $request->session()->flash('message-type', 'bg-green-400');

        return response()->json(['status'=>'Admin added successfully']);
    }

    public function logout() {
        Auth::guard('admin')->user()->tokens()->delete();
        Session::flush();
        Auth::guard('admin')->logout();
        
        return redirect()->route('adminlogin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
