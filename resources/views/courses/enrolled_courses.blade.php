@extends('layouts.student_app')

@section('content')
<div class="flex flex-wrap justify-center h-auto">
    <div class="w-8/12 bg-white p-6 rounded-lg font-mono text-2xl font-semibold">
        Enrolled Courses
    </div>
</div>
<div>
    @foreach ($enrolled as $course)
        <div  onclick="location.href='{{route('viewcourse', ['id' => $course->id])}}'" class="shadow-md cursor-pointer
        hover:bg-blue-500 transition duration-300 hover:text-white hover:border-blue-500 w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-800 border-1 font-mono text-2xl font-semibold">
            <a href="{{route('viewcourse', ['id' => $course->id])}}">{{$course->name}}</a>
            
        </div>
    @endforeach
</div>
@endsection