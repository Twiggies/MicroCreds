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
        <form action="{{route('managequiz', $lessonid)}}" method="post" enctype="multipart/form-data">
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
        
        $('.addNewQues').on('click', function(){
        addNewQues();
        });

        function addNewQues() {
            questions.push({
                question: "",
                options : [
                    {option: 'Option 1', is_answer: false},
                    {option: 'Option 2', is_answer: true}
                ]
            })
            var i = questions.length;
            $('#managequizarea').append(
                '<div class="flex bg-gray-400 border-3 border-black p-2 h-auto rounded-md mb-5" id=q' + i +'>' +
                '<div class="flex text-right"><a href="#" id='+ i +' class="deleteQues">Delete</a></div>'+
                '<table id=question-'+i+'>'+
                '<thead>'+
                '<tr>' +
                '<th class="text-left"><input class="w-full bg-gray-100 border-2 border-gray-500 p-2 rounded-lg" type="text" name=question-'+i+' id=question-'+i+'></th>'+
                '</tr>'+
                '<tr>'+
                    '<th class="text-left"><span>*Select the correct choice by ticking the checkboxes</span></th>'+
                '</tr>' +
                '</thead>' +
                '<tbody class="w-10/12" id=manageoptionsarea-'+i+'></tbody>'+
                '</div>'


            );
                
                    $('#manageoptionsarea-' + i).append(
                        
                    
                    '<tr>' +
                        '<td class="flex"><input  class="h-6 w-6 mt-3 mr-3" type="checkbox" name=option-' + i + '-' + questions[i-1].options.length + ' id=option-' + i + '-' + questions[i-1].options.length + '>' +
                        '<input class="w-3/4 bg-gray-100 border-2 border-gray-500 p-2 rounded-lg" type="text" name=textoption-' + i + '-' + questions[i-1].options.length + ' id=textoption-' + i + '-' + questions[i-1].options.length +  ' placeholder="Option">' +
                        '</td>' +
                    '</tr>'
                    
                
                
                    );
                
                $('#manageoptionsarea-'+ i + ' tr').append(
                '<div class="w-9/12">' +
                    '<a href="#" id=' + i +  ' class="addNewChoice">+Add new choice</a>' +
                '</div>'
                );
                $('.addNewChoice').on('click', 
                addNewChoice
                );

                $('.deleteQues').on('click', 
                deleteQuestion
                );
        };

        function addNewChoice() {
            var i = $(this).attr('id');
            questions[i-1].options.push({
                    option: 'Option ' + (questions[i-1].options.length+1), 
                    is_answer: false
            });
            $('#manageoptionsarea-' + i).append(
                    '<tr>' +
                        '<td class="flex"><input  class="h-6 w-6 mt-3 mr-3" type="checkbox" name=option-' + i + '-' + questions[i-1].options.length + ' id=option-' + i + '-' + questions[i-1].options.length + '>' +
                        '<input class="w-3/4 bg-gray-100 border-2 border-gray-500 p-2 rounded-lg" type="text" name=textoption-' + i + '-' + questions[i-1].options.length + ' id=textoption-' + i + '-' + questions[i-1].options.length +  ' placeholder="Option">' +
                        '</td>' +
                    '</tr>'
                );
            console.log(questions);
        };

        function deleteQuestion() {
            var i = $(this).attr('id');
            console.log(i);
            questions.splice(i-1,i-1);
            $('#q' + i).remove();
        };
    });
    

    
    

    

</script>
@endsection