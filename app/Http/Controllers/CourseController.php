<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Profile;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CourseResource;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        
    }   

    public function viewCourses() {
        $user = Auth::user();
        if ($data = $user->courses()->paginate(5)) {
        return view('courses.created_courses', compact('data'));
        }
        else {
            return view('courses.created_courses');
        }
    }

    public function browse() {

        $data = Course::where('status', 'inactive')->paginate(10);
        return view('courses.browse_courses', compact('data'));
    }

    public function details($course_id) {
        $course = Course::find($course_id);
        $educator = User::find($course->user_id);
        $educator_profile = Profile::where('user_id',$course->user_id)->first();
        return view('courses.course_details', compact('course', 'educator_profile', 'educator'));
        
    }

    public function index() {

        return CourseResource::collection(Course::where('user_id',2)->get());
        //return Course::where('user_id', 2)->get();
    }

    public function addCourse() {
        return view('courses.add_course');
    }


    public function addNewCourse(Request $request) {
        $request->validate([
            'coursename' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'image' => 'nullable | image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'image.max' => "Image should only be 2MB max in size",
        ]
        );

        if ($request->hasFile('image')) {
            $destination_path = 'public/images/courses_thumbnail';
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid().'.'.$extension;
            $path = $request->file('image')->storeAs($destination_path, $image_name);
            $request->user()->courses()->create([
                    'name' => $request->coursename,
                    'description' => $request->description,
                    'duration' => $request->duration,
                    'image' => $image_name,
                    'status' => 'inactive',
                ]);
        }

        else {
             $request->user()->courses()->create([
            'name' => $request->coursename,
            'description' => $request->description,
            'duration' => $request->duration,
            'status' => 'inactive',
            ]);
        }
        return redirect()->route('createdcourses');
    }

    public function editCourse($id) {
        $course = Course::find($id);
        return view('courses.edit_course', compact('course'));
        
    }

    public function updateCourse(Request $request) {
        $course = Course::find($request->id);
        $course->name = $request->coursename;
        $course->description = $request->description;
        $course->duration = $request->duration;
        if ($request->hasFile('image')) {
            Storage::delete('public/images/courses_thumbnail/'.$course->image);
            $destination_path = 'public/images/courses_thumbnail';
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid().'.'.$extension;
            $path = $request->file('image')->storeAs($destination_path, $image_name);
            $course->image = $image_name;
        }
        $course->update();
        $request->session()->flash('message', 'Changes saved');
        $request->session()->flash('message-type', 'bg-green-400');
        return redirect()->route('viewcourse', $request->id)->with('status', 'Course details updated successfully');
    }

    public function viewCourse($id) {
        $data = Course::find($id);
        $modules = $data->modules;
        if (session()->get('isEducator') == true) {
            return view('courses.dashboard', compact('data', 'modules'));
        }
        else {
            return view('courses.student_dashboard', compact('data', 'modules'));
        }
        
    }

    public function enrolled(Request $request) {
        $user = Auth::user();
        $enrollments = $user->enrolls()->get();
        $enrolled = [];
        foreach ($enrollments as $enroll) {
            $course = Course::find($enroll->course_id);
            $enrolled[] = $course;
        }
        return view('courses.enrolled_courses', compact('enrolled'));
    }


    
}
