<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CourseLibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'libraryname' => 'required | max:40'
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
        return view('course_libraries.view_library', compact('library'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseLibrary  $courseLibrary
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseLibrary $courseLibrary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseLibrary  $courseLibrary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseLibrary $courseLibrary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseLibrary  $courseLibrary
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseLibrary $courseLibrary)
    {
        //
    }
}
