<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Material;
use App\Models\Progress;
use Illuminate\Http\Request;
use App\Models\MaterialBridge;
use Illuminate\Support\Facades\DB;
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
        $user = Auth::user();
        $module = Module::find($moduleid);
        $lessons = $module->lessons()->simplePaginate(1);
        $lesson = Lesson::find($lessonid);
        $materials_link = $lesson->material_link()->get();
        $materials = [];
        foreach ($materials_link as $link) {
            $material = Material::find($link->materials_id);
            $materials[] = $material;
        }
        if (session()->get('isEducator') == true) {
            return view('lessons.lesson', compact('id', 'moduleid', 'lessonid', 'lesson', 'materials'));
        }
        else {
            $progress = Progress::where('user_id', $user->id)->where('lesson_id', $lessonid)->first();
            return view('lessons.student_lesson', compact('id', 'moduleid', 'lessonid', 'lesson', 'materials', 'progress', 'lessons'));
        }
        
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
    public function store(Request $request, $id, $moduleid, $lessonid)
    {
        //
        $request->validate([
            'lessonname' => "required | max:30",
        ]);
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

    public function edit($id, $moduleid, $lessonid) {
        $lesson = Lesson::find($lessonid);
        $moduleid = $lesson->module_id;
        $module = Module::find($moduleid);
        $id = $module->course_id;
        $materials_link = $lesson->material_link()->get();
        $attached = [];
        foreach ($materials_link as $link) {
            $material = Material::find($link->materials_id);
            $attached[] = $material;
        }
        $materials = Auth::user()->materials()->get();
        return view('lessons.edit_lesson', compact('id', 'moduleid','lessonid', 'lesson', 'materials', 'attached'));
    }

    public function delete(Request $request) {
        Lesson::find($request->lessonid)->delete();
        $id = $request->id;
        $moduleid = $request->moduleid;
        return redirect()->route('viewmodule', compact('id','moduleid'));
    }

    
}
