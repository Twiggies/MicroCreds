@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center ">
    <div class="flex justify-between w-8/12 bg-white p-4 rounded-lg font-mono text-2xl font-semibold">
        <span>{{$module['name']}}</span>
        <ul class="flex items-center">
            <a class="px-3 border hover:text-white hover:bg-blue-500 border-gray-500 border-2" href="{{route('editmodule', $module['id'])}}">Edit</a>
        </ul>
    </div>
    <div class="w-8/12 bg-white p-3 mt-4 h-full rounded-lg border-2 font-mono text-2xl font-semibold">
        <form action="{{route('addlesson', [$id, 'moduleid' => $module['id']])}}" method="get">
            @csrf
            <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold  hover:text-white py-2 px-4 border border-blue-500 rounded-full" >Add a lesson</button>
        </form>
        <div>
            @foreach ($lessons as $lesson)
            <div class="flex justify-between w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-600 border-2 font-mono text-2xl font-semibold">
                <a href="{{route('viewlesson', [$id, 'moduleid'=>$module['id'],'lessonid' => $lesson->id])}}">{{$lesson->name}}</a>
                <ul class="flex items-center">
                    <a href="{{route('editlesson', ['lessonid' => $lesson->id])}}">Edit</a>
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection