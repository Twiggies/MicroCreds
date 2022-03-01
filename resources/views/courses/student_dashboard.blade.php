@extends('layouts.student_app')

@section('content')
<div class="flex flex-wrap justify-center">
    <div class="flex justify-between w-8/12 bg-white p-4 rounded-lg font-mono text-2xl font-semibold">
        <span>{{$data['name']}}</span>  
        <ul class="flex items-center">
            <a class="px-3 border hover:bg-blue-500 hover:text-white border-gray-500">Students</a>
            <a class="px-3 border hover:bg-blue-500 hover:text-white border-gray-500">Credentials</a>
        </ul>
    </div>
    <div class="w-8/12 bg-white p-3 mt-4 h-full rounded-lg border-2 font-mono text-2xl font-semibold">
        <div>
            @foreach ($modules as $item)
                <div class="w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-600 border-2 font-mono text-2xl font-semibold">
                    <a href="{{route('viewmodule', ['id' => $data['id'], 'moduleid' => $item->id])}}">{{$item->name}}</a>
                </div>
            @endforeach
        </div>
    </div>
    
</div>
@endsection