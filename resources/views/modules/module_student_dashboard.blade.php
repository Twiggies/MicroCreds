@extends('layouts.student_app')

@section('content')
<div class="grid grid-cols-4">
    <div class="col-start-4 col-end-5">
    <a class="mx-2 my-2 transition duration-150 ease-in-out text-indigo-700 px-6 py-2 text-lg focus:outline-none" href="{{route('viewcourse', $id)}}">Go back to dashboard</a>
    </div>
</div>
<div class="flex flex-wrap justify-center ">
    
    <div class="flex justify-between w-8/12 bg-white p-4 rounded-lg ">
        <span class="font-mono text-2xl font-semibold">{{$module['name']}}</span>
        
        <span class="font-semibold">Progress: {{Auth::user()->progress()->where('module_id' , $module['id'])->count()}} out of {{$module->lessons->count()}}
    </div>
    
    <div class="w-8/12 bg-white p-3 mt-4 h-full rounded-lg border-2 font-mono text-2xl font-semibold">
        
        <div>
            @if ($lessons)
            @foreach ($lessons as $lesson)
            <div class="flex justify-between w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-600 border-2 font-mono text-2xl font-semibold shadow-lg
            @if (Auth::user()->progress->where('lesson_id', $lesson->id)->first())
                    bg-green-300 hover:bg-green-500
                @else
                    bg-red-300 hover:bg-red-400
                @endif">
                <a href="{{route('viewlesson', [$id, 'moduleid'=>$module['id'],'lessonid' => $lesson->id])}}">{{$lesson->name}}</a>
            </div>
            @endforeach
            @else
            <div class="flex justify-between w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-600 border-2 font-mono text-2xl font-semibold">
                <span>You have no modules.</span>
            </div>
            @endif
            
        </div>
    </div>
</div>
@endsection