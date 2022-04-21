@extends('layouts.app')

@section('content')
<div class="grid grid-cols-6">
    <div class="col-start-5 col-end-6 text-right">
    <a class="mx-2 my-2 hover:text-purple-600 py-2 text-lg focus:outline-none underline" href="{{route('viewcourse', $id)}}">Go back to dashboard</a>
    </div>
</div>
<div class="flex flex-col items-center justify-center ">
    
    <div class="relative flex flex-wrap justify-between w-8/12 bg-white p-4 rounded-lg font-sans text-2xl font-semibold shadow-sm">
        <span class="w-5/6">{{$module['name']}}
            <div class="flex font-sans font-normal text-base">
                {{$module['description']}}
            </div>
        </span>
        
        <ul class="flex items-center">
            <a class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 focus:bg-gray-400 hover:bg-gray-400 focus:text-white hover:text-white font-normal bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-indigo-600 focus:outline-none transition duration-150 
            ease-in-out hover:bg-gray-300 rounded text-indigo-600 px-6 py-2 text-lg" href="{{route('editmodule', [$id, $moduleid])}}">Edit</a>
        </ul>
        
    </div>
    @if (session('message'))
    <div class="{{session('message-type')}} w-8/12 font-semibold p-3 rounded-lg my-3">
    {{session('message')}}
    </div>
    @endif
    <div class="w-8/12 bg-white p-3 mt-4 h-full rounded-lg border-2 font-sans text-2xl font-semibold shadow-lg">
        <form action="{{route('addlesson', [$id, 'moduleid' => $module['id']])}}" method="get">
            @csrf
            <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold font-sans text-base  hover:text-white py-2 px-4 border border-blue-500 rounded-full" >Add a lesson</button>
        </form>
        <div>
            @if ($lessons)
            @foreach ($lessons as $lesson)
            <div class="relative shadow-md cursor-pointer
            hover:bg-blue-500 focus:ring-blue-500 focus:ring-offset-2 focus:ring-2 transition duration-300 hover:text-white hover:border-blue-500 w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-800 border-1 font-sans text-2xl font-semibold">
                
                <a href="{{route('viewlesson', [$id, 'moduleid'=>$module['id'],'lessonid' => $lesson->id])}}">{{$lesson->name}}</a>
                <a class="mr-2 absolute right-0 px-2 hover:bg-white hover:text-black rounded-full" href="{{route('editlesson', [$id, 'moduleid'=>$module['id'], 'lessonid' => $lesson->id])}}">Edit</a>
                
            </div>
            @endforeach
            @else
            <div class="flex justify-between w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-600 border-2 font-sans text-2xl font-semibold">
                <span>You have no lessons.</span>
            </div>
            @endif
            
        </div>
    </div>
</div>
@endsection