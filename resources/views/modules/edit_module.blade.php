@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center h-auto items-center">
    <div class="w-8/12 bg-white p-6 mt-10 h-full rounded-lg">
        <div>
            <form action="{{route('editmodule', [$id, $moduleid])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <span>Module Name</span>
                        <input type="text" name="modulename" id="modulename"
                        class="bg-gray-100 border-2 border-gray-500 p-4 rounded-lg w-full @error('modulename') border-red-500 @enderror" value="{{$module->name}}">
                        @error('modulename')
                            <div class="text-red-500 mt-2 text-sm text-left">
                                {{ $message }}
                            </div>                        
                        @enderror
                </div>
                
                <div>
                <span>Description</span>
                        <textarea  name="description" id="description"
                        class="bg-gray-100 border-2 border-gray-500 p-4 rounded-lg w-full h-128 @error('description') border-red-500 @enderror" value="">{{$module->description}}</textarea>
                        @error('description')
                            <div class="text-red-500 mt-2 text-sm text-left">
                                {{ $message }}
                            </div>                        
                        @enderror
                </div>
                <div class="my-4 relative text-right">
                    <button class="absolute left-0 text-left bg-red-400 hover:bg-red-500 text-white font-bold p-2 rounded" type="button" onclick="modalHandler(true)">Delete</button>
                    <a href="javascript:history.back()" class="btn btn-default underline">Cancel</a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold p-2 rounded w-auto">
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
            <p tabindex="0" class="focus:outline-none mb-5 text-sm text-gray-600 dark:text-gray-400 text-center font-normal">You're about to delete this module and this action cannot be undone. Are you sure?</p>
            <div class="flex items-center justify-between w-full">
                <button type="button" onclick="modalHandler()" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 focus:outline-none transition duration-150 ease-in-out hover:bg-gray-600 bg-gray-400 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm">Cancel</button>
                <button type="button" onclick="location.href='{{route('deletemodule', [$id, $moduleid])}}'" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 focus:outline-none transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm">Yes</button>
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