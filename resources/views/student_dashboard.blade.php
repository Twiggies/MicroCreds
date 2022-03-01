@extends('layouts.student_app')

@section('content')
<example-component></example-component>
    <div class="flex flex-wrap justify-center h-96">
        <div class="w-10/12 bg-white p-6 rounded-lg font-mono text-2xl font-semibold">
            Welcome, {{ucfirst(auth()->user()->firstname)}}
        </div>
        <div class="w-1/3 bg-white p-6 mt-10 h-full rounded-lg">
            <a href="browsecourses">Browse Courses</a>
        </div><div class="w-1/3 bg-white p-6 mt-10 h-full rounded-lg">
            <a href="">Enrolled Courses</a>
        </div>
        <div class="w-1/3 bg-white p-6 mt-10 h-full rounded-lg">
            <a href="">My Credentials</a>
        </div>
    </div>
@endsection