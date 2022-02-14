<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
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
    public function index($lessonid)
    {
        //
        $quizzes = Lesson::find($lessonid)->quiz()->get();
        foreach ($quizzes as $quiz) {
            $quiz->options = $quiz->options()->get();
        }
        return response()->json([
            'quiz' => $quizzes,
            
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lessonid)
    {
        //
        $lesson = Lesson::find($lessonid);
        $moduleid = $lesson->module_id;
        $module = Module::find($moduleid);
        $id = $module->course_id;
        return view('quiz.manage_quiz', compact('id', 'moduleid','lessonid'));
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
        $datas = $request->questions;
        foreach (json_decode($datas) as $data) {
            if ($data->id) {
                if ($data->is_removed != true) {
                    $quiz = Quiz::find($data->id);
                    $quiz->question = $data->question;
                    foreach ($data->options as $options) {
                        $option = Option::find($options->id);
                        $option->option = $options->option;
                        $option->is_answer = $option->is_answer;
                        $option->update();
                    }
                    $quiz->update();
                }
            }
            if ($data->is_removed != true && !$data->id) {
                $quiz = $lesson->quiz()->create([
                    'question' => $data->question
                ]);
                foreach($data->options as $option) {
                    $quiz->options()->create([
                        'option' => $option->option,
                        'is_answer' => $option->is_answer
                    ]);
                }
            }
        }

        return response('Request received');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit($lessonid)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(quiz $quiz)
    {
        //
    }
}
