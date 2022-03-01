<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
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
    public function index($id, $moduleid)
    {
        //
        
        $module = Course::find($id)->modules()->find($moduleid);
        $lessons = $module->lessons()->get();
        return view('modules.module_dashboard', compact('id','moduleid', 'module', 'lessons'));
        
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        return view('modules.add_module', compact('id'));
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
            'modulename' => 'required',
            'description' => 'required'
        ]);

        $request->user()->courses()->find($request->id)->modules()->create([
            'name' => $request->modulename,
            'description' => $request->description,
            
        ]);
        
        return redirect()->route('viewcourse', $request->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $moduleid)
    {
        //
        $module = Module::find($id);
        return view('modules.edit_module', compact('id', 'moduleid', 'module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $module = Module::find($request->moduleid);
        $module->name = $request->modulename;
        $module->description = $request->description;
        $module->update();
        $moduleid = $request->moduleid;
        $id = $module->course_id;
        return redirect()->route('viewmodule', compact('id', 'moduleid'))->with('status', 'Course details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        //
    }
}
