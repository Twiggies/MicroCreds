<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $moduleid, $lessonid)
    {
        //
        $lesson = Lesson::find($lessonid);
        return view('lessons.lesson', compact('id', 'moduleid', 'lessonid', 'lesson'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $moduleid)
    {
        //
        //return view('lessons.add_lesson', compact('id','moduleid'));
        //dd($id);
        $user = Auth::user();
        $user->courses()->find($id)->modules()->find($moduleid)->lessons()->create([
            'name' => 'New Lesson',
            'content' => '',
            'module_id' => $moduleid
        ]);

        return redirect()->route('viewmodule', compact('id','moduleid'));
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
        $lesson = Lesson::find($request->lessonid);
        $lesson->name = $request->lessonname;
        $lesson->content = $request->content;
        $lesson->update();
        $lessonid = $request->lessonid;
        $moduleid = $lesson->module_id;
        $module = Module::find($moduleid);
        $id = $module->course_id;
        return redirect()->route('viewlesson', compact('id', 'moduleid', 'lessonid', 'lesson'));
        
    }

    public function edit($lessonid) {
        $lesson = Lesson::find($lessonid);
        return view('lessons.edit_lesson', compact('lessonid', 'lesson'));
    }

    
}
