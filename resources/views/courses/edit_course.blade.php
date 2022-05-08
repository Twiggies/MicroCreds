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
                    <input type="text" name="coursename" id="coursename"
                    class="bg-gray-100 border-2 border-gray-500 p-4 rounded-lg w-full @error('coursename') border-red-500 @enderror" value="{{$course->name}}">
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
            @if ($course->status != 'published')
            <button formaction='{{route('publishcourse', ['id' => $course->id])}}'
                class="bg-blue-500 text-white px-3 py-2 rounded-md text-md font-medium hover:bg-blue-700 transition duration-300">Publish</button>
            @else 
            <button formaction='{{route('archivecourse', ['id' => $course->id])}}'
                class="bg-blue-500 text-white px-3 py-2 rounded-md text-md font-medium hover:bg-blue-700 transition duration-300">Archive</button>
            @endif
            
            </div>
            <div class="relative my-4 text-right">
                <button type="button" onclick="modalHandler(true)"
                    class="absolute left-0 bg-red-500 text-white px-3 py-2 rounded-md text-md font-medium hover:bg-red-700 transition duration-300">Delete</button>
                <a href="{{route('viewcourse', $course->id)}}" class="btn btn-default underline">Cancel</a>
                <button type="submit" class="bg-green-400 text-white font-bold p-2 rounded hover:bg-green-500 transition duration-300  font-large w-auto">
                    Update
                </button>
            </div>
          </form>
        </div>
    </div>
</div>

<div class="hidden py-12 bg-gray-700 dark:bg-gray-900 transition duration-150 ease-in-out z-10 fixed inset-0 overflow-y-auto" id="modal">
    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
        <div class="relative py-8 px-8 md:px-16 bg-white dark:bg-gray-800 dark:border-gray-700 shadow-md rounded border border-gray-400">
            
            <div class="w-full flex justify-center text-green-400 mb-4">
                <img width="56" height="56" src="https://upload.wikimedia.org/wikipedia/commons/d/d9/Warning_sign_font_awesome-red.svg" alt="icon"/>
                
            </div>
            <h1 tabindex="0" class="focus:outline-none text-center text-gray-800 dark:text-gray-100 font-lg font-bold tracking-normal leading-tight mb-4">Alert!</h1>
            <p tabindex="0" class="focus:outline-none mb-5 text-sm text-gray-600 dark:text-gray-400 text-center font-normal">You're about to delete this course and this action cannot be undone. Are you sure?</p>
            <div class="flex items-center justify-between w-full">
                <button type="button" onclick="modalHandler()" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 focus:outline-none transition duration-150 ease-in-out hover:bg-gray-600 bg-gray-400 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm">Cancel</button>
                <button type="button" onclick="location.href='{{route('deletecourse', $course->id)}}'" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 focus:outline-none transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm">Yes</button>
            </div>
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        let modal = document.getElementById("modal");
        function modalHandler(val) {
            if (val) {
                fadeIn(modal);
            } else {
                fadeOut(modal);
            }
        }
        function fadeOut(el) {
            el.style.opacity = 1;
            (function fade() {
                if ((el.style.opacity -= 0.1) < 0) {
                    el.style.display = "none";
                } else {
                    requestAnimationFrame(fade);
                }
            })();
        }
        function fadeIn(el, display) {
            el.style.opacity = 0;
            el.style.display = display || "flex";
            (function fade() {
                let val = parseFloat(el.style.opacity);
                if (!((val += 0.2) > 1)) {
                    el.style.opacity = val;
                    requestAnimationFrame(fade);
                }
            })();
        }
    </script>
@endsection