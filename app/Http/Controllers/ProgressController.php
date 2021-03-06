<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Course;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        $progress = Progress::create([
            'user_id' => $user->id,
            'course_id' => $request->id,
            'module_id' => $request->moduleid,
            'lesson_id' => $request->lessonid,
            'quiz_completed' => false,
        ]);
        if (!Quiz::where('lesson_id', $request->lessonid)->first()) {
            $progress->quiz_completed = 1;
            $progress->update();
        }
        $course = Course::find($request->id); 
        foreach ($course->modules as $module) {
            foreach ($module->lessons as $lesson) {
            if (!Auth::user()->progress()->where('lesson_id' , $lesson->id)->where('quiz_completed',1)->first()) {
                return redirect()->back();
            }
        }
        }

        

        return redirect()->route('generate', ['id' => $request->id]);
    }

    public function complete(Request $request) {
        $user = auth()->user();
        $progress = Progress::where('user_id',$user->id)->where('lesson_id', $request->lessonid)->first();
        $progress->quiz_completed = 1;
        $progress->update();
        return response('Successful');
    }

    public function check(Request $request) {
        $course = Course::find($request->id); 
        foreach ($course->modules as $module) {
            foreach ($module->lessons as $lesson) {
            if (!Auth::user()->progress()->where('lesson_id' , $lesson->id)->where('quiz_completed',1)->first()) {
                return redirect()->back();
            }
        }
        }
        return redirect()->route('generate', ['id' => $request->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function show(Progress $progress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function edit(Progress $progress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Progress $progress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function destroy(Progress $progress)
    {
        //
    }
}
