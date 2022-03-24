
@extends('layouts.app')

@section('content')

<div class="flex flex-col justify-center items-center">
    <div onclick="location.href='{{route('createdcourses')}}'" class="cursor-pointer hover:text-purple-600 w-8/12 text-right text-lg underline">
        Go back to your courses
    </div>
    <div class="flex justify-between w-8/12 bg-white p-4 rounded-lg font-mono text-2xl font-semibold">
        <span>{{$data['name']}}</span>  
        <ul class="flex items-center">
            <a class="bg-blue-500 text-white px-4 py-2 border text-1xl font-medium hover:bg-blue-700 transition duration-300" href="{{route('editcourse', $data['id'])}}">Edit</a>
            <a class="bg-blue-500 text-white px-4 py-2 border text-1xl font-medium hover:bg-blue-700 transition duration-300">Students</a>
            <a class="bg-blue-500 text-white px-4 py-2 border text-1xl font-medium hover:bg-blue-700 transition duration-300" href="{{route('managecred', $data['id'])}}">Credentials</a>
        </ul>
    </div>
    @if (session('message'))
    <div class="{{session('message-type')}} w-8/12 font-semibold p-3 rounded-lg my-3">
    {{session('message')}}
    </div>
    @endif
    <div class="w-8/12 bg-white p-3 mt-4 h-full rounded-lg border-2 font-mono text-2xl font-semibold">
        <form action="{{route('addmodule', $data['id'])}}" method="get">
            @csrf
            <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-sans text-base font-semibold  hover:text-white py-2 px-4 border border-blue-500 rounded-full" >Add a module</button>
        </form>
        <div>
            @foreach ($modules as $item)
                <div onclick="location.href='{{route('viewmodule', ['id' => $data['id'], 'moduleid' => $item->id])}}'" class="relative shadow-md cursor-pointer
                    hover:bg-blue-500 transition duration-300 hover:text-white hover:border-blue-500 w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-800 border-1 font-mono text-2xl font-semibold">
                    <a href="{{route('viewmodule', ['id' => $data['id'], 'moduleid' => $item->id])}}">{{$item->name}}</a>
                    <a class="mr-2 absolute right-24 px-2 hover:bg-white hover:text-black rounded-full" href="{{route('editmodule', ['id'=>$data->id, 'moduleid'=>$item->id])}}">Edit</a>
                    <a class="mr-2 absolute right-0 px-2 hover:bg-white hover:text-black rounded-full" href="{{route('deletemodule', ['id'=>$data->id, 'moduleid'=>$item->id])}}">Delete</a>
                </div>
            @endforeach
        </div>
    </div>
    
</div>



@endsection 






