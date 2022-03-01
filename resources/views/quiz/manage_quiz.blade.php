@extends('layouts.app')


@section('content')
<div class="flex flex-wrap justify-center h-full">
    <div class="flex justify-between w-8/12 p-6 h-full rounded-lg">
        Manage Quiz
        <div class="flex items-right">
            <a class="px-3 border-gray-500 border-2" href="{{route('viewlesson', [$id, $moduleid, $lessonid])}}">Go back to lesson page</a>
        </div>
        
    </div>
    <div class="w-8/12 justify-between py-4 px-10 h-auto rounded-lg">
        <form id="quizform" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="w-10/12" id="managequizarea">
            
            
            
        </div>
        
        
        <div class="w-9/12">
            <a href="#" class="addNewQues">+Add new question</a>
        </div>
        <div>
            <div class="w-11/12 my-4 text-right">
                <a href="{{url()->previous()}}" class="btn btn-default underline">Cancel</a>
                <button type="submit" class="bg-green-400 text-white font-bold p-2 rounded font-large w-auto">
                    Save
                </button>
            </div>
        </div>
    </form>
    </div>

</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        var questions= [];
        $.ajax({
            type: 'GET',
            url: "{{route('getquiz', $lessonid)}}",
            success: function(response) {
                var data = response.quiz;
                for (var i = 0; i < data.length; i++) {
                    questions.push({
                        id: data[i].id,
                        question: data[i].question,
                        options: data[i].options,
                        is_removed: false

                    });
                    
                    $('#managequizarea').append(
                    '<div class="shadow-lg questionbody flex bg-gray-400 border-3 border-black p-2 h-auto rounded-md mb-5" id=q' + (i+1) +'>' +
                    '<div class="flex text-right"><span id='+ (i+1) +' class="deleteQues cursor-pointer p-3 h-auto">&times;</span></div>'+
                    '<table id=question-'+(i+1)+'>'+
                    '<thead>'+
                    '<tr>' +
                    '<th class="text-left"><input class="question w-full bg-gray-100 border-2 border-gray-500 p-2 rounded-lg" type="text" name=question-'+(i+1)+' id=question-'+(i+1)+' value="'+ questions[i].question + '"></th>'+
                    '</tr>'+
                    '<tr>'+
                        '<th class="text-left"><span>*Select the correct choice by ticking the checkboxes</span></th>'+
                    '</tr>' +
                    '</thead>' +
                    '<tbody class="w-10/12" id=manageoptionsarea-'+(i+1)+'></tbody>'+
                    '</div>'
                    );
                    $('#manageoptionsarea-'+ (i+1) ).append(
                    '<div class="w-9/12">' +
                        '<a href="#" id=' + (i+1) +  ' class="addNewChoice">+Add new choice</a>' +
                    '</div>'
                    );

                    for (var j = 0; j < data[i].options.length; j++) {
                       

                    $('#manageoptionsarea-' + (i+1)).append(
                        
                    
                    '<tr>' +
                        '<td class="flex"><input  class="checkbox h-6 w-6 mt-3 mr-3" type="checkbox" name=' + (i+1) + ' id=option-' + (i+1) + '-' + (j+1) + '>' +
                        '<input class="choice w-3/4 bg-gray-100 border-2 border-gray-500 p-2 rounded-lg" type="text" name=' + (i+1) + ' id=textoption-' + (i+1) + '-' + (j+1) + ' value=' + questions[i].options[j].option + ' placeholder="Option">' +
                        '</td>' +
                    '</tr>'
                    );

                    if (questions[i].options[j].is_answer == 1) {
                        
                            $('#option-'+(i+1)+'-'+(j+1)).prop('checked', true);
                        }
                    
                    }
       
                }
                console.log(questions);
            }
        });
        


                $('.addNewQues').on('click', function(){
                addNewQues();
                });

                $('body').on('click', '.addNewChoice', 
                addNewChoice
                );

                $('body').on('click', '.deleteQues',
                deleteQuestion
                );

                $('body').on('click', '.checkbox', function() {
                    
                        var i = $(this).attr('name');
                        var j = $(this).index('.checkbox')+1;
                        for (var x = 0; x < i-1; x++) {
                            j -= questions[x].options.length;
                        }
                        questions[i-1].options[j-1].is_answer = !questions[i-1].options[j-1].is_answer;
                        console.log(questions);
                    
                });
                
                $('body').on('change', '.choice', function() {
                    var i = $(this).attr('name');
                    var j = $(this).index('.choice')+1;
                    for (var x = 0; x < i-1; x++) {
                        j -= questions[x].options.length;
                    }
                    questions[i-1].options[j-1].option = this.value;
                    console.log(questions);
                });
                
                $('body').on('change', '.question', function() {
                    var i = $(this).index('.question')+1;
                    questions[i-1].question = this.value;
                    console.log(questions);
                });
        function addNewQues() {
            questions.push({
                question: "",
                options : [
                    {option: 'Option 1', is_answer: false}
                ],
                is_removed: false
            })
            var i = questions.length;
            $('#managequizarea').append(
                '<div class="shadow-lg questionbody flex bg-gray-400 border-3 border-black p-2 h-auto rounded-md mb-5" id=q' + i +'>' +
                '<div class="flex text-right"><span id='+ i +' class="deleteQues cursor-pointer p-3">&times;</span></div>'+
                '<table id=question-'+i+'>'+
                '<thead>'+
                '<tr>' +
                '<th class="text-left"><input class="question w-full bg-gray-100 border-2 border-gray-500 p-2 rounded-lg" type="text" name=question-'+i+' id=question-'+i+'></th>'+
                '</tr>'+
                '<tr>'+
                    '<th class="text-left"><span>*Select the correct choice by ticking the checkboxes</span></th>'+
                '</tr>' +
                '</thead>' +
                '<tbody class="w-10/12" id=manageoptionsarea-'+i+'></tbody>'+
                '</div>'


            );
                $('#manageoptionsarea-'+ i ).append(
                    '<div class="w-9/12">' +
                        '<a href="#" id=' + i +  ' class="addNewChoice">+Add new choice</a>' +
                    '</div>'
                    );

                    $('#manageoptionsarea-' + i).append(
                        
                    
                    '<tr>' +
                        '<td class="flex"><input  class="checkbox h-6 w-6 mt-3 mr-3" type="checkbox" name=' + i + ' id=option-' + i + '-' + questions[i-1].options.length + '>' +
                        '<input class="choice w-3/4 bg-gray-100 border-2 border-gray-500 p-2 rounded-lg" type="text" name=' + i + ' id=textoption-' + i + '-' + questions[i-1].options.length +  ' placeholder="Option">' +
                        '</td>' +
                    '</tr>'
                    
                
                
                    );
                
                
                
        };

        function addNewChoice() {
            var i = $(this).attr('id');
            
            questions[i-1].options.push({
                    option: 'Option ' + (questions[i-1].options.length+1), 
                    is_answer: false,
                   
            });
            $('#manageoptionsarea-' + i).append(
                    '<tr>' +
                        '<td class="flex"><input  class="checkbox h-6 w-6 mt-3 mr-3" type="checkbox" name=' + i + ' id=option-' + i + '-' + questions[i-1].options.length + '>' +
                        '<input class="choice w-3/4 bg-gray-100 border-2 border-gray-500 p-2 rounded-lg" type="text" name=' + i + ' id=textoption-' + i + '-' + questions[i-1].options.length +  ' placeholder="Option">' +
                        '</td>' +
                    '</tr>'
                );
            console.log(questions);
        };

        function deleteQuestion() {
            var i = $(this).attr('id');
            console.log(i);
            questions[i-1].is_removed = true;
            $('#q' + i).remove();
        };
        

        $('#quizform').submit(function(e) {
            e.preventDefault();
            console.log(JSON.stringify(questions));
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type:"PUT",
                data: {questions:JSON.stringify(questions)},
                url: "{{route('updatequiz', $lessonid)}}",
                success: function(response) {
                    alert(response);
                },
                error: (error) => {
                     console.log(JSON.stringify(error));
                }
            });
        });
    });
    
    

    

</script>
@endsection