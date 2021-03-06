@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center h-auto">
    <div class="w-8/12 bg-white p-6 rounded-lg font-sans text-2xl font-semibold shadow-sm">
        Created Courses
    </div>
    <div class="w-8/12 bg-white p-6 mt-10 h-full rounded-lg shadow-md">
        @csrf
        <form action="{{route('addcourse')}}" method="GET">
            <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold  hover:text-white py-2 px-4 border border-blue-500 rounded-full">Add New Course</button>
        </form>
        <div class="my-3">
            @foreach ($data as $course)
                <div class="shadow-md cursor-pointer
                hover:bg-blue-500 transition duration-300 hover:text-white hover:border-blue-500 w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-800 border-1 font-sans text-2xl font-semibold">
                    <a href="{{route('viewcourse', ['id' => $course->id])}}">{{$course->name}}</a>
                    
                </div>
            @endforeach
        </div>
        <div> 
            {{$data->links()}}
        </div>
    </div>
    </div>
@endsection