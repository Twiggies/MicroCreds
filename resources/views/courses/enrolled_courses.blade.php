@extends('layouts.student_app')

@section('content')
<div class="flex flex-wrap justify-center h-auto">
    <div class="w-8/12 bg-white p-6 rounded-lg font-sans text-2xl font-semibold">
        Enrolled Courses
    </div>
</div>
<div class="flex flex-col items-center justify-center">
<div class="w-8/12 bg-white p-3 mt-4 h-full rounded-lg border-2 ">
    @foreach ($enrolled as $course)
            @php
                $total = 0;
                foreach ($course->modules as $module)  {
                    $total += $module->lessons->count();
                }
                
            @endphp
        
        <div  onclick="location.href='{{route('viewcourse', ['id' => $course->id])}}'" class="relative shadow-md cursor-pointer
         transition duration-300 hover:text-white  w-8/13  p-3 mt-4 h-full rounded-lg border-gray-800 border-1 font-sans text-2xl font-semibold
        @if (Auth::user()->progress()->where('course_id', $course->id)->where('quiz_completed',1)->count() == $total)
            bg-green-300 hover:bg-green-400
        @else
            bg-red-300 hover:bg-red-400
        @endif
        ">
            <a href="{{route('viewcourse', ['id' => $course->id])}}">{{$course->name}}</a>
            <a class="font-medium p-1 text-base absolute right-2 font-sans">Progress: {{Auth::user()->progress()->where('course_id', $course->id)->where('quiz_completed',1)->count()}} out of {{$total}} lessons</a>
        </div>
        
    @endforeach
</div>

</div>
@endsection