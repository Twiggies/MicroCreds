
@extends('layouts.app')

@section('content')

<div class="flex flex-col justify-center items-center">
    <div class="w-8/12 relative text-right">
        <a onclick="location.href='{{route('createdcourses')}}'" class="cursor-pointer hover:text-purple-600 text-lg underline">
            Go back to your courses
        </a>
    </div>
    <div class="flex justify-between w-8/12 bg-white p-4 rounded-lg font-sans text-2xl font-semibold shadow-sm">
        <span>{{$data['name']}} <span>(Status:{{ucfirst($data['status'])}})</span></span>
        <ul class="flex items-center space-x-2">
            <a class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 focus:bg-gray-400 hover:bg-gray-400 focus:text-white hover:text-white font-normal bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-indigo-600 focus:outline-none transition duration-150 
                    ease-in-out hover:bg-gray-300 rounded text-indigo-600 px-6 py-2 text-lg" href="{{route('editcourse', $data['id'])}}">Edit</a>
            <a class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 focus:bg-gray-400 hover:bg-gray-400 focus:text-white hover:text-white font-normal bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-indigo-600 focus:outline-none transition duration-150 
                    ease-in-out hover:bg-gray-300 rounded text-indigo-600 px-6 py-2 text-lg" href="{{route('students', [$data['id'], $data])}}">Students</a>
            <a class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 focus:bg-gray-400 hover:bg-gray-400 focus:text-white hover:text-white font-normal bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-indigo-600 focus:outline-none transition duration-150 
                    ease-in-out hover:bg-gray-300 rounded text-indigo-600 px-6 py-2 text-lg" href="{{route('managecred', $data['id'])}}">Credentials</a>
        </ul>
    </div>
    @if (session('message'))
    <div class="{{session('message-type')}} w-8/12 font-semibold p-3 rounded-lg my-3">
    {{session('message')}}
    </div>
    @endif
    <div class="w-8/12 bg-white p-3 mt-4 h-full rounded-lg border-2 font-sans text-2xl font-semibold shadow-md">
        <form action="{{route('addmodule', $data['id'])}}" method="get">
            @csrf
            <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-sans text-base font-semibold  hover:text-white py-2 px-4 border border-blue-500 rounded-full" >Add a module</button>
        </form>
        <div>
            @foreach ($modules as $item)
                <div onclick="location.href='{{route('viewmodule', ['id' => $data['id'], 'moduleid' => $item->id])}}'" class="relative shadow-md cursor-pointer
                    hover:bg-blue-500 transition duration-300 hover:text-white hover:border-blue-500 w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-800 border-1 font-sans text-2xl font-semibold">
                    <a href="{{route('viewmodule', ['id' => $data['id'], 'moduleid' => $item->id])}}">{{$item->name}}</a>
                    <a class="mr-2 absolute right-0 px-2 hover:bg-white hover:text-black rounded-full" href="{{route('editmodule', ['id'=>$data->id, 'moduleid'=>$item->id])}}">Edit</a>
                    
                </div>
            @endforeach
        </div>
    </div>
    
</div>



@endsection 






