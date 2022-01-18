@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center">
    <div class="flex justify-between w-8/12 bg-white p-4 rounded-lg font-mono text-2xl font-semibold">
        <span>{{$data['name']}}</span>
        <ul class="flex items-center">
            <a class="px-3 border border-gray-500">Edit</a>
            <a class="px-3 border border-gray-500">Students</a>
        </ul>
    </div>
    <div class="w-8/12 bg-white p-3 mt-4 h-full rounded-lg border-2 font-mono text-2xl font-semibold">
        <form action="{{route('addmodule', $data['id'])}}" method="get">
            @csrf
            <button class="w-13 border-2" >Add a module</button>
        </form>
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