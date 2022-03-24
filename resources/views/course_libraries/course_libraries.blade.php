@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center h-96">
    <div class="w-8/12 bg-white p-6 rounded-lg text-3xl font-semibold">
        Course Libraries
    </div>
    <div class="w-8/12 bg-white p-6 mt-10 h-full rounded-lg">
        @csrf
        <form action="{{route('addlibrary')}}" method="GET">
            <button class="bg-transparent hover:bg-blue-500 hover:text-white text-blue-700 font-semibold   py-2 px-4 border border-blue-500 rounded-full">Add New Library</button>
        </form>
        <div>
            @if ($libraries)
            @foreach ($libraries as $library)
            <div 
            class="relative shadow-md cursor-pointer
            hover:bg-blue-500 transition duration-300 hover:text-white hover:border-blue-500 w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-800 border-1 font-mono text-2xl font-semibold">
                
                <a href="{{route('viewlibrary', $library)}}">{{$library->name}}</a>
                
                <a class="mr-2 absolute right-24 px-2 hover:bg-white hover:text-black rounded-full"href="{{route('editlibrary', $library)}}">Edit</a>
                <a class="mr-2 absolute right-0 px-2 hover:bg-white hover:text-black rounded-full"href="{{route('deletelibrary', $library)}}">Delete</a>
                
            </div>
            
            @endforeach
            @else
            <div class="flex justify-between w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-600 border-2 font-mono text-2xl font-semibold">
                <span>You have no libraries.</span>
            </div>
            @endif
            
        </div>
    </div>
    </div>
@endsection