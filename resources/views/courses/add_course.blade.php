@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center h-auto items-center space-x-6">
    <div class="w-8/12 bg-white p-6 mt-10 h-full rounded-lg">
        <div>
        <form action="{{route('addnewcoursereq')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="my-3">
                <span>Course Name</span>
                    <input type="text" name="coursename" id="coursename"
                    class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm 
                    border-gray-300 @error('coursename') border-red-500 @enderror" value="{{old('coursename')}}">
                    @error('coursename')
                        <div class="text-red-500 mt-2 text-sm text-left">
                            {{ $message }}
                        </div>                        
                    @enderror
            </div>
            <div class="my-3">
                <span>Image</span>
                <label class="block">
                <span class="sr-only">Choose image</span>
                <input type="file"  name="image" class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-violet-700
                    hover:file:bg-violet-100
                "/>
                </label>
            </div>
            <div class="my-3">
            <span>Description</span>
                    <textarea  name="description" id="description"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md @error('description') border-red-500 @enderror" value="{{old('description')}}"></textarea>
                    @error('description')
                        <div class="text-red-500 mt-2 text-sm text-left">
                            {{ $message }}
                        </div>                        
                    @enderror
            </div>
            <div class="my-3">
                <span>Duration</span>
                        <input type="text"  name="duration" id="duration"
                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm 
                        border-gray-300 @error('duration') border-red-500 @enderror" value="{{old('duration')}}">
                        @error('duration')
                            <div class="text-red-500 mt-2 text-sm text-left">
                                {{ $message }}
                            </div>                        
                        @enderror
            </div>
            <div class="my-4 text-right">
                <a href="{{route('createdcourses')}}" class="btn btn-default underline">Cancel</a>
                <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white font-bold p-2 rounded rounded font-large w-auto">
                    Create
                </button>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection