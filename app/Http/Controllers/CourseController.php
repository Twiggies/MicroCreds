<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewCourses() {
        $user = Auth::user();
        if ($data = $user->courses()->get()) {
        return view('courses.created_courses', compact('data'));
        }
        else {
            return view('courses.created_courses');
        }
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
        ]);

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
                ]);
        }

        else {
             $request->user()->courses()->create([
            'name' => $request->coursename,
            'description' => $request->description,
            'duration' => $request->duration,
            
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
        $course->update();
        return redirect()->route('viewcourse', $request->id)->with('status', 'Course details updated successfully');
    }

    public function viewCourse($id) {
        $data = Auth::user()->courses()->find($id);
        if ($modules = $data->modules()->get()) {
        return view('courses.dashboard', compact('data', 'modules'));
        }
        else {
            return view('courses.dashboard', compact('data'));
        }
    }
}
