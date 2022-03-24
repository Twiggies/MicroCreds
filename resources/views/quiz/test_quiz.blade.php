@extends('layouts.app')

@section('content')
<div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-1 pt-6 gap-8">
    <div>
    <ul class="gap-5 flex">
        <li><button onclick="location.href='{{route('viewlesson', [$id,$moduleid,$lessonid])}}'" class="my-2 bg-white transition duration-150 ease-in-out font-semibold hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-4 py-2  focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700">Go back to lesson</button></li>
        <li><button onclick="location.href='{{route('viewcourse', $id)}}'" class="my-2 bg-white transition duration-150 ease-in-out font-semibold hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-4 py-2  focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700">Go back to course dashboard</button></li>
        <li><button onclick="location.href='{{route('managequiz', [$id, $moduleid,$lessonid])}}'" class="my-2 bg-white transition duration-150 ease-in-out font-semibold hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-4 py-2  focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700">Edit Quiz</button></li>
    </ul>
    </div>
    <div>
        <h1 class="font-medium text-4xl text-indigo-900">Quiz</h1>
    </div>
    <!-- Remove class [ h-24 ] when adding a card block -->
    <!-- Remove class [ border-gray-300  dark:border-gray-700 border-dashed border-2 ] to remove dotted border -->
    
    @foreach ($quizzes as $quiz)
    <div id="question{{$quiz->id}}" class="rounded border-gray-500 dark:border-gray-700 border-dashed border-2 px-3 py-2">
        <h1 tabindex="0"  class="focus:outline-none text-xl font-medium pr-2 leading-5 text-gray-800">{{$quiz->question}}</h1>
            @foreach ($quiz->options as $option)
            <label for="{{$option->id}}" class="block mt-4 border border-gray-300 rounded-lg py-2 px-6 text-lg hover: cursor-pointer hover:bg-white" >
                <input id="{{$option->id}}" type="radio" class="option hidden">{{$option->option}}
            </label>
            @endforeach
            
            
    </div>
    @endforeach 
    
    <div class="hidden py-12 bg-gray-700 dark:bg-gray-900 transition duration-150 ease-in-out z-10 fixed inset-0 overflow-y-auto" id="modal">
        <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
            <div class="relative py-8 px-8 md:px-16 bg-white dark:bg-gray-800 dark:border-gray-700 shadow-md rounded border border-gray-400">
                
                <div class="w-full flex justify-center text-green-400 mb-4">
                    <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/centre_aligned_short-svg1.svg" alt="icon"/>
                    
                </div>
                <h1 tabindex="0" class="focus:outline-none text-center text-gray-800 dark:text-gray-100 font-lg font-bold tracking-normal leading-tight mb-4">Congratulations!</h1>
                <p tabindex="0" class="focus:outline-none mb-5 text-sm text-gray-600 dark:text-gray-400 text-center font-normal">You have passed the quiz for this lesson.</p>
                <div class="flex items-center justify-center w-full">
                    <button onclick=modalHandler() class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 focus:outline-none transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm">Complete the lesson.</button>
                    
                </div>
                
            </div>
        </div>
    </div>
    
    
    
    

    
    

    <div class="hidden py-12 bg-gray-700 dark:bg-gray-900 transition duration-150 ease-in-out z-10 fixed inset-0 overflow-y-auto" id="failed_modal">
        <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
            <div class="relative py-8 px-8 md:px-16 bg-white dark:bg-gray-800 dark:border-gray-700 shadow-md rounded border border-gray-400">
                
                <div class="w-full flex justify-center text-green-400 mb-4">
                    <img width="56" height="56" src="https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg" alt="icon"/>
                    
                </div>
                <h1 tabindex="0" class="focus:outline-none text-center text-gray-800 dark:text-gray-100 font-lg font-bold tracking-normal leading-tight mb-4">Unfortunately</h1>
                <p tabindex="0" class="focus:outline-none mb-5 text-sm text-gray-600 dark:text-gray-400 text-center font-normal">You did not pass the quiz as at least 80% accuracy is required. You will have to reattempt the quiz again.</p>
                <div class="flex items-center justify-center w-full">
                    <button onclick=location.reload() class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 focus:outline-none transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm">Retry the quiz.</button>
                    
                </div>
                
            </div>
        </div>
    </div>
    
  
  


</div>
@endsection

@section('scripts')
    <script>
        var total_questions = @json($quizzes);
        var correct = 0;
        var i = 0;
        $(".option").on('click', function() {
            i++;
            var answer_id = this.id;
            var question = $(this).parent().closest('div').attr('id');
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: "POST",
                async: false,
                url: "{{route('checkanswer')}}",
                data: {answer_id:answer_id},
                success: function(response) {
                    switch (response.is_answer) {
                        case true:
                            correct++;
                            $("#"+answer_id).parent().closest('label').addClass('bg-green-300 hover:bg-green-400');
                            $("#"+question+" :input").prop('disabled', true);
                            
                            break;
                        
                        case false:
                            alert(response.response);
                            $("#"+answer_id).parent().closest('label').addClass('bg-red-300 hover:bg-red-400');
                            var correct_answers = response.correct_answers;

                            /*for (var i = 0; i < correct_answers.length; i++) {
                                $("#"+correct_answers[i].id).parent().closest('label').addClass('bg-green-300 hover:bg-green-400');
                            }*/
                            $("#"+question+" :input").prop('disabled', true);
                            break;
                        default:
                            break;
                    }
                    
                    
                },
            })
            
            if (i == total_questions.length) {
                console.log((correct/total_questions.length)*100);
                if (correct/total_questions.length > 0.8) {
                    modalHandler(true);
                }
                else {
                    failedmodalHandler(true);
                }

            }
        })
    </script>
    <script>
        let modal = document.getElementById("modal");
        let failed_modal = document.getElementById('failed_modal');
        function modalHandler(val) {
            if (val) {
                fadeIn(modal);
            } else {
                fadeOut(modal);
            }
        }
        function failedmodalHandler (val) {
            if (val) {
                fadeIn(failed_modal);
            }
            else {
                fadeOut(failed_modal);
            }
        }
        function fadeOut(el) {
            el.style.opacity = 1;
            (function fade() {
                if ((el.style.opacity -= 0.1) < 0) {
                    el.style.display = "none";
                } else {
                    requestAnimationFrame(fade);
                }
            })();
        }
        function fadeIn(el, display) {
            el.style.opacity = 0;
            el.style.display = display || "flex";
            (function fade() {
                let val = parseFloat(el.style.opacity);
                if (!((val += 0.2) > 1)) {
                    el.style.opacity = val;
                    requestAnimationFrame(fade);
                }
            })();
        }
    </script>
    <script>
        function completeQuiz() {
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: 'GET',
                url: "{{route('completequiz', [$id, $moduleid, $lessonid])}}",
                success: function(response) {
                    modalHandler(false);
                },
                error: function(error) {
                    console.log(error);
                }
            })
            
        }
    </script>
@endsection