@extends('layouts.app')

@section('content')
<example-component></example-component>
    <div class="flex flex-wrap justify-center h-96">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            Welcome, {{ucfirst(auth()->user()->firstname)}}
        </div>
        <div class="w-8/12 bg-white p-6 mt-10 h-full rounded-lg">
            <a href="{{route('createdcourses')}}">Created Courses</a>
        </div>
    </div>
@endsection