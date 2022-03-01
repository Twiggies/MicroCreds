<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\MaterialBridge;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class MaterialController extends Controller
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
        $materials = $user->materials()->get();
        return view('materials.materials', compact('materials'));
    }

    public function fetch() {
        $materials = Auth::user()->materials()->get();
        return response($materials, 200);
    }

    public function attach(Request $request) {
        $user = Auth::user();
        $input = $request->selectedFile;
        $file_id = json_decode($input);
        $lesson_id = $request->lessonid;
        MaterialBridge::create([
            'lesson_id' => $lesson_id,
            'materials_id' => $file_id
        ]);
        return response('Attached', 200);
    }

    public function download($file) {
        $document = Material::where('file', $file)->first();
        $author_id = $document->user_id;
        return Storage::download('public/files/materials/'.$author_id.'/'.$file);
    }

    public function delete($file, $id) {
        $user = Auth::user();
        Storage::delete('public/files/materials/'.$user->id.'/'.$file);
        Auth::user()->materials()->findOrFail($id)->delete();
        return redirect()->route('materials');
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
        
            $request->validate([
                'material' => 'required|mimes:pdf,doc,docx,ppt,pptx|max:2048'
            ]);
            if ($request->hasFile('material')) {
            
            $destination_path = 'public/files/materials/'.$user->id;
            if (!File::exists($destination_path)) {
                File::makeDirectory($destination_path, $mode=0777, true, true);
            }
            $file = $request->file('material');
            $file_name = $file->getClientOriginalName();
            $path = $request->file('material')->storeAs($destination_path, $file_name);
            $user->materials()->create([
                'file' => $file_name,
            ]);
            return response('File uploaded successfully');
            }
            
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //
    }
}
