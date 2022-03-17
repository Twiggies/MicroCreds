@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center h-auto items-center space-x-6">
    <div class="w-8/12 bg-white p-6 mt-10 h-full rounded-lg">
        <div>
        <form action="{{route('updatecourse', $course->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <span>Course Name</span>
                    <textarea name="coursename" id="coursename"
                    class="bg-gray-100 border-2 border-gray-500 p-4 rounded-lg w-full @error('coursename') border-red-500 @enderror" value="">{{$course->name}}</textarea>
                    @error('coursename')
                        <div class="text-red-500 mt-2 text-sm text-left">
                            {{ $message }}
                        </div>                        
                    @enderror
            </div>
            <div>
                
                <span>Image</span>
                
                <label class="block border-2 border-gray-500 rounded-lg">
                <span class="sr-only">Choose image</span>
                <input type="file"  name="image" class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-violet-700
                    hover:file:bg-violet-100
                "/>
                @if ($course->image != null)
                <img id="image" src="{{asset('storage/images/courses_thumbnail/'.$course->image)}}"
                tabindex="0" class="focus:outline-none w-64 h-48" />
                @else 
                <img alt="course stock image" src="https://img.freepik.com/free-vector/students-watching-webinar-computer-studying-online_74855-15522.jpg?t=st=1646212180~exp=1646212780~hmac=8623cbe2b9978c9e95924211171c9d39e45333f62cf51a0fbe509fd8b057465a&w=1380" 
                tabindex="0" class="focus:outline-none w-64 h-48" />
                @endif
                </label>
            </div>
            <div>
            <span>Description</span>
                    <textarea  name="description" id="description"
                    class="bg-gray-100 border-2 border-gray-500 p-4 rounded-lg w-full h-128 @error('description') border-red-500 @enderror" value="">{{$course->description}}</textarea>
                    @error('description')
                        <div class="text-red-500 mt-2 text-sm text-left">
                            {{ $message }}
                        </div>                        
                    @enderror
            </div>
            <div>
                <span>Duration</span>
                        <input type="text"  name="duration" id="duration"
                        class="bg-gray-100 border-2 border-gray-500 p-4 rounded-lg w-full h-128 @error('duration') border-red-500 @enderror" value="{{$course->duration}}">
                        @error('duration')
                            <div class="text-red-500 mt-2 text-sm text-left">
                                {{ $message }}
                            </div>                        
                        @enderror
            </div>
            <div class="my-4 text-right">
            <button formaction='{{route('publishcourse', ['id' => $course->id])}}'
                class="bg-blue-500 text-white px-3 py-2 rounded-md text-md font-medium hover:bg-blue-700 transition duration-300">Publish</button>
            </div>
            <div class="my-4 text-right">
                <a href="{{url()->previous()}}" class="btn btn-default underline">Cancel</a>
                <button type="submit" class="bg-green-400 text-white font-bold p-2 rounded hover:bg-green-500 transition duration-300  font-large w-auto">
                    Update
                </button>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection