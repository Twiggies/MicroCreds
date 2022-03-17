<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        if (!$profile = Profile::find($user->id)) {
            $profile = Profile::create([
                'user_id' => $user->id
            ]);
            
        }
        if (session()->get('isEducator') == true)
        return view('profiles.profile', compact('profile'));

        return view('profiles.student_profile', compact('profile'));
    }

    public function edit() {
        $profile = Profile::where('user_id',Auth::user()->id)->first();
        if (session()->get('isEducator') == true)
        return view('profiles.edit_profile', compact('profile'));

        return view('profiles.student_edit_profile', compact('profile'));
    }

    public function update(Request $request) {
        $request->validate([
            'firstname' => 'max:40',
            'lastname' => 'max:50',
            'about' => 'max:300',
            'institute' => 'max:50 | nullable',
            'picture' => 'nullable | image |mimes:jpeg,png,jpg |max:2048'
        ],
        [
            'picture' => "Image should only be 2MB max in size",
        ]
        );
        
        $user = Auth::user();
        $profile = Profile::find($user->id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
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
        $user->update();
        $profile->update();

        return redirect()->route('myprofile');
    }
}
