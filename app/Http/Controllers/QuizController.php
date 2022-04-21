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
    public function create($id, $moduleid, $lessonid)
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
            if (isset($data->id)) {
                if ($data->is_removed != true) {
                    $quiz = Quiz::find($data->id);
                    $quiz->question = $data->question;
                    foreach ($data->options as $options) {
                        $option = Option::find($options->id);
                        $option->option = $options->option;
                        if ($options->is_answer == 1) {
                        $option->is_answer = 1;
                        }
                        else {
                            $option->is_answer = 0;
                        }
                        $option->update();
                    }
                    $quiz->update();
                }
                else if ($data->is_removed == true) {
                    Quiz::findOrFail($data->id)->delete();
                }
            }
            else if ($data->is_removed != true && !isset($data->id)) {
                if ($data->question != "") {
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
            
        }

        return response('Changes saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, $moduleid, $lessonid) 
    {
        //
        $quizzes = Lesson::find($request->lessonid)->quiz;
        
        foreach ($quizzes as $quiz) {
            $quiz->options = $quiz->options;
        }
        //dd($quizzes);
        if (session()->get('isEducator') == true) {
        return view('quiz.test_quiz', compact('quizzes', 'id', 'moduleid', 'lessonid'));
        }
        return view('quiz.quiz', compact('quizzes', 'id', 'moduleid', 'lessonid'));
    }

    public function check(Request $request) {
        $answer = Option::find($request->answer_id);
        if ($answer->is_answer == 1) {

            return response()->json(['response' => 'Correct answer', 'is_answer' => true]);
        }
        
            $correct_answers = Option::where('quiz_id', $answer->quiz_id)->where('is_answer', 1)->get();
            return response()->json(['response' => 'Incorrect answer', 'correct_answers' => $correct_answers, 'is_answer' => false]);
        
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
