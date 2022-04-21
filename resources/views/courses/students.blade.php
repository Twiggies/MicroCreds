@extends('layouts.app')

@section('content')

<div class="p-4 flex flex-col">
    <div class="relative">
        <a class="absolute right-0 text-lg underline cursor-pointer hover:text-purple-700" href="{{route('viewcourse', $course->id)}}">Go back to course</a>
    </div>
    <div>
        <h1 class="font-semibold text-xl">{{$course->name}}</h1>
    </div>
    <h1 class="text-3xl">
        Students
    </h1>
    
</div>
<div class="px-3 py-4 flex justify-center">
    <table class="w-full text-md bg-white shadow-md rounded mb-4">
        <tbody>
            <tr class="border">
                <th class="border text-left p-2 px-3">Email</th>
                <th class="border text-left p-2 px-3">Firstname</th>
                <th class="border text-left p-2 px-3">Lastname</th>
                <th class="border text-left p-2 px-3">Progress</th>
                <th class="border w-3 text-left p-2 px-3">Action</th>
            </tr>
            @foreach ($students as $student)
                
           
            <tr class="border border-collapse hover:bg-yellow-100 bg-gray-100">
                <td class="border p-2 px-3">{{$student->email}}</td>
                <td class="border p-2 px-3">{{$student->firstname}}</td>
                <td class="border p-2 px-3">{{$student->lastname}}</td>
                @php
                $total = 0;
                foreach ($course->modules as $module)  {
                    $total += $module->lessons->count();
                }
                
                @endphp
                <td class="border p-2 px-3">{{$student->progress()->where('course_id' , $course->id)->where('quiz_completed',1)->count()}} out of {{$total}} lessons</td>
                <td class="border p-2 px-3"> <button onclick="location.href='{{route('viewprofile', ['user_id'=>$student->id])}}'" class="bg-blue-500 text-white text-sm px-3 py-2 rounded-md text-md font-medium hover:bg-blue-700 transition duration-300">View Profile</button></td>
                
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>

@endsection