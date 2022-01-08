@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center">
    <div class="flex justify-between w-8/12 bg-white p-4 rounded-lg font-mono text-2xl font-semibold">
        <span>{{$data['name']}}</span>
        <ul class="flex items-center">
            <button class="px-3 border border-gray-500">Edit</button>
            <button class="px-3 border border-gray-500">Students</button>
        </ul>
    </div>
    <div class="w-8/12 bg-white p-3 mt-4 h-full rounded-lg border-2 font-mono text-2xl font-semibold">
        <button class="w-13 border-2">Add a module</button>
        <div>
            
        </div>
    </div>
    
</div>
@endsection