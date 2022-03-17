@extends('layouts.app')

@section('content')
<a class="mx-2 my-2 bg-white transition duration-150 ease-in-out hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-6 py-2 text-sm underline focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700" href="{{route('viewmodule', [$id,$moduleid])}}">Go back to lesson module</a>
<div class="flex flex-wrap justify-center h-auto">
    
    <div class="flex justify-between w-8/12 h-1/6 bg-white border-3 p-3 mb-3">
        <ul class="flex justify-right">
            <a class="mx-2 my-2 bg-white transition duration-150 ease-in-out hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-6 py-2 text-lg focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700" href="{{route('editlesson', [$id,$moduleid,$lessonid])}}">Edit</a>
            
        </ul>
    </div>
</div>

<div id="lessoncontent" class="flex flex-col items-center justify-center h-auto">
    
<div class="w-8/12 bg-white p-6 h-full rounded-lg">
    @foreach ($materials as $material)
    <div>
        <a class="hover:text-blue-900 text-blue-500 underline" href="{{route('downloadFile', $material->file)}}" >{{$material->file}}</a>
    </div>
    @endforeach
    <div>
    {!!$lesson->content!!}
    </div>
    
</div>
<div class="w-full mt-10 border-t-2 border-gray-300 text-right h-auto">
    <button onclick="location.href='{{route('showquiz', [$id, $moduleid, $lessonid])}}'" class="font-bold mx-2 my-2 bg-white transition duration-150 ease-in-out hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-6 py-2 text-lg focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700">Proceed to Quiz
    </button>
    </div>
</div>


@endsection
@section('scripts')
<script>
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
                    is_removed: false,

                });
            }
            console.log(questions);
        }
    });
});
</script>
@endsection