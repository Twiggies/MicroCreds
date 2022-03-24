@extends('layouts.student_app')

@section('content')
<div class="grid grid-cols-6">
    <div class="col-start-5 col-end-6 text-right">
    <a class="my-2 transition duration-150 ease-in-out text-indigo-700 py-2 text-lg focus:outline-none" href="{{route('viewcourse', $id)}}">Go back to dashboard</a>
    </div>
</div>
<div class="flex flex-wrap justify-center ">
    
    <div class="flex justify-between w-8/12 bg-white p-4 rounded-lg ">
        <span class="w-5/6 font-mono text-2xl font-semibold">{{$module['name']}}
                <div class="flex font-sans font-normal text-base">
                    {{$module['description']}}
                </div>
        </span>
        
        <span class="font-semibold">Progress: {{Auth::user()->progress()->where('module_id' , $module['id'])->count()}} out of {{$module->lessons->count()}}
    </div>
    
    <div class="w-8/12 bg-white p-3 mt-4 h-full rounded-lg border-2 font-mono text-2xl font-semibold">
        
        <div>
            @if ($lessons)
            @foreach ($lessons as $lesson)
            <div class="relative flex justify-between w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-600 border-2 font-mono text-2xl font-semibold shadow-lg
                @if (Auth::user()->progress->where('lesson_id', $lesson->id)->first())
                    @if (Auth::user()->progress->where('lesson_id', $lesson->id)->where('quiz_completed',1)->first())
                    bg-green-300 hover:bg-green-500
                    @php
                        $complete = "Complete";    
                    @endphp
                    @else
                    bg-yellow-200 hover:bg-yellow-300
                    @php 
                        $complete = "Quiz Pending";
                    @endphp
                    @endif
                @else
                    @php 
                        $complete = "Incomplete";
                    @endphp
                    bg-red-300 hover:bg-red-400
                @endif">
                <a href="{{route('viewlesson', [$id, 'moduleid'=>$module['id'],'lessonid' => $lesson->id])}}">{{$lesson->name}}</a>
                <span class="absolute text-base font-sans font-semibold right-2">Status: {{$complete}}</span>
            </div>
            @endforeach
            
            @endif
            
        </div>
    </div>
</div>
@endsection