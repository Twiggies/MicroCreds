@extends('layouts.student_app')

@section('content')
<a class="mx-2 my-2 bg-white transition duration-150 ease-in-out hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-6 py-2 text-sm underline focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700" href="{{route('viewmodule', [$id,$moduleid])}}">Go back to lesson module</a>


<div id="lessoncontent" class="flex flex-wrap justify-center h-auto">
    
<div class="w-8/12 bg-white px-4 pt-3 pb-2 h-full rounded-lg shadow-md">
    <a class="font-bold text-2xl">{{$lesson->name}}</a>
    @foreach ($materials as $material)
    <div>
        <a class="hover:text-blue-900 text-blue-500 underline" href="{{route('downloadFile', $material->file)}}" >{{$material->file}}</a>
    </div>
    @endforeach
    <div>
    {!!$lesson->content!!}
    </div>
    <div class="mt-10 border-t-2 border-gray-300 text-right h-auto">
        @if ($progress != null)
        <button onclick="location.href='{{route('showquiz', [$id, $moduleid, $lessonid])}}'" class="font-bold mx-2 my-2 bg-white transition duration-150 ease-in-out hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-6 py-2 text-lg focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700">Proceed to Quiz
        </button>
        @else
        <button onclick="location.href='{{route('completelesson', [$id, $moduleid, $lessonid])}}'" class="font-bold mx-2 my-2 bg-white transition duration-150 ease-in-out hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-6 py-2 text-lg focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700">Complete This Lesson
        </button>
        @endif
        
    </div>
    <div>
        {{ $lessons->links() }}
    </div>
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