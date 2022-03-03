@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap justify-center h-96">
        <div class="w-10/12 bg-white p-6 rounded-lg font-mono text-2xl font-semibold">
            Welcome, {{ucfirst(auth()->user()->firstname)}}
        </div>
        <div class="w-1/3 bg-white p-6 mt-10 h-full rounded-lg">
            <a href="{{route('createdcourses')}}">Created Courses</a>
        </div><div class="w-1/3 bg-white p-6 mt-10 h-full rounded-lg">
            <a href="{{route('courselibraries')}}">Course Libraries</a>
        </div>
        <div class="w-1/3 bg-white p-6 mt-10 h-full rounded-lg">
            <a href="{{route('materials')}}">Materials</a>
        </div>
    </div>
@endsection