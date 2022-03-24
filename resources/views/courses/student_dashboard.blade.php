@extends('layouts.student_app')

@section('content')
<div class="grid grid-cols-6">
    <div class="col-start-5 col-end-6 text-right">
    <a class="my-2 transition duration-150 ease-in-out text-indigo-700 py-2 text-lg focus:outline-none" href="{{route('enrolledcourses')}}">Go back to courses</a>
    </div>
</div>
<div class="flex flex-wrap justify-center">
    <div class="flex justify-between w-8/12 bg-white p-4 rounded-lg ">
        <span class="font-mono text-2xl font-semibold">{{$data['name']}}
            
        </span>  
            @php
                $total = 0;
                foreach ($data->modules as $module)  {
                    $total += $module->lessons->count();
                }
                
            @endphp
        <span class="font-semibold">Progress: {{Auth::user()->progress()->where('course_id' , $data['id'])->count()}} out of {{$total}}
            
       </span>
        <ul class="flex items-center font-mono text-2xl font-semibold">
            <a class="px-3 border hover:bg-blue-500 hover:text-white border-gray-500">Students</a>
            
        </ul>
    </div>
    <div class="w-8/12 bg-white p-3 mt-4 h-full rounded-lg border-2 font-mono text-2xl font-semibold">
        <div>
            @foreach ($modules as $module)
                <div class="w-8/13 relative bg-white p-3 mt-4 h-full rounded-lg border-gray-600 border-2 font-mono text-2xl font-semibold shadow-lg 
                @if (Auth::user()->progress()->where('module_id', $module->id)->where('quiz_completed',1)->count() == $module->lessons->count())
                    
                    bg-green-300 hover:bg-green-500
                    @php
                        $complete = "Complete";    
                    @endphp
                    
                    
                @else
                    @php
                        $complete = "Incomplete";    
                    @endphp
                    bg-red-300 hover:bg-red-400
                @endif
                ">
                    <a href="{{route('viewmodule', ['id' => $data['id'], 'moduleid' => $module->id])}}">{{$module->name}}
                        </a>
                        <span class="absolute text-base font-sans font-semibold right-2">Status: {{$complete}}</span>
                    
                </div>
            @endforeach
        </div>
    </div>
    
</div>
@endsection