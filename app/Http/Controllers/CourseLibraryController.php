<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\CourseLibrary;
use Illuminate\Support\Facades\DB;
use App\Models\CourseLibraryBridge;
use Illuminate\Support\Facades\Auth;


class CourseLibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
        $user = Auth::user();
        $libraries = $user->libraries()->get();
        return view('course_libraries.course_libraries', compact('libraries'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('course_libraries.add_library');
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
            'libraryname' => 'required | max:40',
            'description' => 'nullable | max:150',
        ]);

        $user = Auth::user();
        $library = $user->libraries()->create([
            'name' => $request->libraryname,
            'description' => $request->description,
        ]);
        
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseLibrary  $courseLibrary
     * @return \Illuminate\Http\Response
     */
    public function show($courseLibrary)
    {
        //
        $library = CourseLibrary::find($courseLibrary);
        $courses = Auth::user()->courses;
        $library_bridges = CourseLibraryBridge::where('library_id', $library->id)->get();
        $added_courses = [];
        foreach ($library_bridges as $bridge) {
            $added_course = Course::find($bridge->course_id);
            $added_courses[] = $added_course;
        }
        return view('course_libraries.view_library', compact('library', 'added_courses', 'courses'));
    }

    public function addcourse(Request $request) {
        $library = $request->library;
        $selectedCourse = $request->selectedCourse;
        CourseLibraryBridge::create([
            'course_id' => $selectedCourse,
            'library_id' => $library,
        ]);
        $request->session()->flash('message', 'Course has been added');
        $request->session()->flash('message-type', 'bg-green-400');
        return response('Attached', 200);
    }

    public function deletecourse(Request $request) {
        $library_id = $request->library;
        $courseid = $request->course;
        CourseLibraryBridge::where('library_id', $library_id)->where('course_id', $courseid)->first()->delete();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseLibrary  $courseLibrary
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $library = CourseLibrary::find($request->library);
        return view('course_libraries.edit_library', compact('library'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseLibrary  $courseLibrary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $library = CourseLibrary::find($request->library);
        $request->validate([
            'libraryname' => 'required | max:40',
            'description' => 'nullable | max:150',
        ]);
        $library->name = $request->libraryname;
        $library->description = $request->description;
        $library->update();
        $request->session()->flash('message', 'Changes saved');
        $request->session()->flash('message-type', 'bg-green-400');
        return redirect()->route('viewlibrary', $library);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseLibrary  $courseLibrary
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        //
        CourseLibrary::find($request->library)->delete();
        return redirect()->route('courselibraries');
    }
}
