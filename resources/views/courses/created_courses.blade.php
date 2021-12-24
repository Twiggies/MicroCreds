@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center h-96">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        Created Courses
    </div>
    <div class="w-8/12 bg-white p-6 mt-10 h-full rounded-lg">
        <form action="{{route('addcourse')}}" method="GET">
            <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 rounded-full">Add New Course</button>
        </form>
        <div>
            @foreach ($data as $course)
                <div class="w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-600 border-2 font-mono text-2xl font-semibold">
                    <a href="{{route('viewcourse', ['id' => $course->id])}}">{{$course->name}}</a>
                    
                </div>
            @endforeach
        </div>
    </div>
    </div>
@endsection