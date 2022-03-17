@extends('layouts.app')

@section('content')
@if (session('message'))
    <div class="{{session('message-type')}} w-full font-semibold p-3 rounded-lg my-3">
    {{session('message')}}
    </div>
    @endif
<div class="md:grid md:grid-cols-4 md:gap-6">
    <div class="mt-5 md:mt-0 md:col-span-2 md:col-start-2  ">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="md:grid md:grid-cols-2  px-4 py-5 bg-white sm:p-6">
                <div class="md:col-span-1">
                    <span class=" text-2xl font-semibold text-gray-700">{{$library->name}}</span>
                </div>
                <div class="md:col-span-1 text-right">
                    <button onclick="location.href='{{route('editlibrary', $library)}}'" class="focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 focus:bg-gray-400 hover:bg-gray-400 focus:text-white hover:text-white font-normal bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-indigo-600 focus:outline-none transition duration-150 
                    ease-in-out hover:bg-gray-300 rounded text-indigo-600 px-6 py-2 text-sm">Edit</button>
                    <button onclick="modalHandler(true)" class="focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 focus:bg-gray-400 hover:bg-gray-400 focus:text-white hover:text-white font-normal bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-indigo-600 focus:outline-none transition duration-150 
                    ease-in-out hover:bg-gray-300 rounded text-indigo-600 px-6 py-2 text-sm">Add course to library</button>
                    <button onclick="location.href='{{route('deletelibrary', $library)}}'" class="focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 focus:bg-gray-400 hover:bg-gray-400 focus:text-white hover:text-white font-normal bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-indigo-600 focus:outline-none transition duration-150 
                    ease-in-out hover:bg-gray-300 rounded text-indigo-600 px-6 py-2 text-sm">Delete</button>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="mt-5 md:grid md:grid-cols-8 md:gap-5">
    <div class="md:mt-0 md:col-span-6 md:col-start-3 ">
        <div class="w-8/12 bg-white p-3 mt-4 h-full rounded-lg border-2 font-mono text-2xl font-semibold">
            <div>
            @foreach ($added_courses as $added_course)
            <div class="border-2 relative shadow-md cursor-pointer
            hover:bg-blue-500 transition duration-300 hover:text-white hover:border-blue-500 w-8/13 bg-white p-3 mt-4 h-full rounded-lg border-gray-800 border-1 font-mono text-2xl font-semibold">

                <a href="{{route('viewcourse', $added_course->id)}}">{{$added_course->name}}</a>
                <a href="{{route('deletecoursefromlibrary', [$library, 'course' => $added_course->id])}}" class="mr-2 absolute right-0 px-2 hover:bg-white hover:text-black  rounded-full" href="">Delete</a> 
                
                
            </div>
            @endforeach
            </div>
        </div>
    </div>
</div>

<div class="hidden py-12 bg-gray-700 dark:bg-gray-900 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0" id="modal">
    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
        <div class="relative p-4 md:p-8 bg-white dark:bg-gray-800 shadow-md rounded border border-gray-400">
            <div aria-label="upload icon" role="img" class="w-full flex items-center justify-start text-gray-600 dark:text-gray-400 mb-5">
                <img class="dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/left_aligned_file_upload-svg1.svg" alt="icon"/>
                <img class="hidden dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/left_aligned_file_upload-svg1dark.svg" alt="icon"/>
                
                <h1 class="text-left text-gray-800 dark:text-gray-100 font-lg font-bold tracking-normal leading-tight ml-2">Add Course</h1>
            </div>
            
            
            
            <p class="mb-5 text-md text-gray-600 dark:text-gray-400 text-left font-semibold">Select a course to be added to this library.</p>
            <div class="flex justify-left">
                <div class="mb-3 xl:w-96">
                  <select id="attach-form" class="form-select appearance-none
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding bg-no-repeat
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                    <option selected>Select a course</option>
                      @foreach ($courses as $course)
                        <option value={{$course->id}}>{{$course->name}}</option>
                      @endforeach
                  </select>
                </div>
              </div>

            
            <div class="flex items-center justify-start w-full">
                <button id="addCourse" onclick="add()" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm ">Save</button>
                <button class="focus:outline-none ml-3 focus:ring-2 focus:ring-offset-2  focus:ring-gray-500 bg-gray-100 dark:bg-gray-700 dark:border-gray-700 dark:hover:bg-gray-600 transition duration-150 text-gray-600 dark:text-gray-400 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" onclick="modalHandler()">Cancel</button>
            </div>
            <button class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 dark:text-gray-400 transition duration-150 ease-in-out focus:ring-2 focus:outline-none focus:ring-gray-400 rounded" onclick="modalHandler()" aria-label="close modal" role="button">
                <svg  xmlns="http://www.w3.org/2000/svg"  class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
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
function add() {
    
    let selectedCourse = $('#attach-form').find(":selected").val();

    $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
    $.ajax({
        type: "POST",
        data: {selectedCourse:selectedCourse},
        url: "{{route('addcoursetolibrary', $library)}}",
        
        success: function(response) {
            location.reload();
        },
        error: function(error) {
            console.log(JSON.stringify(error));
        }
    });
}
</script>
@endsection