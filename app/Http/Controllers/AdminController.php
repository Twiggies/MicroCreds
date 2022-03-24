<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        if ($request->has('search')) {
            $admins = Admin::where('username', 'LIKE', '%'.$request->search.'%')->get();
        }
        return view('admin.admin_list', compact('admins'));
    }

    public function educators(Request $request) {
        $educators = User::where('type', 'educator')->get();
        if ($request->has('search')) {
            $educators = User::where('email', 'LIKE', '%'.$request->search.'%')->orWhere('firstname', 'LIKE', '%'.$request->search.'%')->orWhere('lastname', 'LIKE', '%'.$request->search.'%')->where('type','educator')->get();
        }
        return view('admin.educator_list', compact('educators'));
    }

    public function students(Request $request) {
        $students = User::where('type', 'student')->get();
        if ($request->has('search')) {
            $educators = User::where('email', 'LIKE', '%'.$request->search.'%')->orWhere('firstname', 'LIKE', '%'.$request->search.'%')->orWhere('lastname', 'LIKE', '%'.$request->search.'%')->where('type','student')->get();
        }
        return view('admin.student_list', compact('students'));
    }


    public function edituser(Request $request) {
        $user = User::find($request->user_id);
        $profile = Profile::where('user_id', $request->user_id)->first();
        if (!$profile) {
            $request->session()->now('errormessage', 'This user has not set up their profile yet. Therefore only their name and email are available.');
            $request->session()->now('error-message-type', 'bg-red-400');
        }
        return view('admin.edit_user', compact('profile','user'));
    }

    public function saveuser(Request $request) {
        $request->validate([
            'firstname' => 'max:40',
            'lastname' => 'max:50',
            'about' => 'max:300 | nullable',
            'institute' => 'max:50 | nullable',
            'picture' => 'nullable | image |mimes:jpeg,png,jpg |max:2048'
        ],
        [
            'picture' => "Image should only be 2MB max in size",
        ]
        );
        
        $user = User::find($request->user_id);
        $profile = Profile::find($user->id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        if ($profile) {
        $profile->about = $request->about;
        $profile->institute = $request->institute;
        $profile->linkedin = $request->linkedin;
        if ($request->hasFile('picture')) {
            $destination_path = 'public/images/profile/'.$user->id;
            if (!File::exists($destination_path)) {
                File::makeDirectory($destination_path, $mode=0777, true, true);
            }
            $image = $request->file('picture');
            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid().'.'.$extension;
            $path = $request->file('picture')->storeAs($destination_path, $image_name);
            $profile->picture = $image_name;
        }
        $profile->update();
        }
        $user->update();
        $request->session()->flash('message', 'Changes saved successfully');
        $request->session()->flash('message-type', 'bg-green-400');
        return redirect()->back();
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
        $courses = Course::where('status', 'pending')->get();
        if ($request->has('search')) {
            $courses = Course::where('status', 'pending')->where('name', 'LIKE', '%'.$request->search.'%')->get();
        }
        return view('admin.course_list', compact('courses'));
    }

    public function coursedetails(Request $request) {
        $course = Course::find($request->course_id);
        $educator = User::find($course->user_id);
        $educator_profile = Profile::where('user_id', $educator->id)->first();
        return view('admin.course_details', compact('course','educator', 'educator_profile'));
    }

    public function approve(Request $request) {
        $course = Course::find($request->course_id);
        $course->status = 'published';
        $course->update();
        $request->session()->flash('message', $course->name.' published successfully.');
        $request->session()->flash('message-type', 'bg-green-400');
        return redirect()->route('pendingcourses');
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
        if(Auth::guard('admin')->user()) {
        Auth::guard('admin')->user()->tokens()->delete();
        Session::flush();
        Auth::guard('admin')->logout();
        }
        
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
