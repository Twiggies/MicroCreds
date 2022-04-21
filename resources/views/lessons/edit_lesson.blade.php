@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center h-auto">
<div class="w-8/12 bg-white p-6 h-full rounded-lg">
   
    <div class="flex justify-between w-8/11 bg-white p-6 h-full rounded-lg">
         <ul class="flex items-right">
            <a class="mx-2 my-2 bg-white transition duration-150 ease-in-out hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-6 py-2 text-lg focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700" href="{{route('managequiz', [$id, $moduleid,$lessonid])}}">Manage Quiz</a>
            <button onclick="modalHandler(true)" class="mx-2 my-2 bg-white transition duration-150 ease-in-out hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-6 py-2 text-lg focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700">Attach Materials</button>
            <a onclick="deleteHandler(true)" class="mx-2 my-2 bg-white transition duration-150 ease-in-out hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-6 py-2 text-lg focus:outline-none focus:ring-2 focus:ring-offset-2 cursor-pointer  focus:ring-indigo-700">Delete this page</a>
        </ul>
    </div> 
    <form action="{{route('updatelesson', [$id, $moduleid, $lessonid])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="px-6">
    
    
    <input type="text" name="lessonname" id="lessonname"
        class="bg-gray-100 border-2 border-gray-500 p-2 rounded-lg w-1/4 @error('lessonname') border-red-500 @enderror" value="{{$lesson->name}}">
        @error('lessonname')
                    <div class="text-red-500 mt-2 text-sm text-left">
                        {{ $message }}
                    </div>
         @enderror
    </div>
    @foreach ($attached as $attachfile)
    <div>{{$attachfile->file}} <a onclick ="location.href='{{route('deattach', [$id, $moduleid, $lessonid, 'material_id' => $attachfile->id])}}'" class="cursor-pointer underline text-red-500 hover:text-red-800">Remove</a></div>
    @endforeach
    <div class="w-full bg-white p-6 mt-3 h-full rounded-lg">
        <textarea id="tinymce" name="content">{!!$lesson->content!!}</textarea>
            <div>
                <div class="my-4 text-right">
                    <a href="javascript:history.back()" class="btn btn-default underline">Cancel</a>
                    <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded text-lg w-auto">
                        Save
                    </button>
                </div>
            </div>
        
    </div>
    </form>
    

    <div class="hidden py-12 bg-gray-700 dark:bg-gray-900 transition duration-150 ease-in-out z-10 fixed  top-0 right-0 bottom-0 left-0" id="modal">
        <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
            <div class="relative p-4 md:p-8 bg-white dark:bg-gray-800 shadow-md rounded border border-gray-400">
                <div aria-label="upload icon" role="img" class="w-full flex items-center justify-start text-gray-600 dark:text-gray-400 mb-5">
                    <img class="dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/left_aligned_file_upload-svg1.svg" alt="icon"/>
                    <img class="hidden dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/left_aligned_file_upload-svg1dark.svg" alt="icon"/>
                    
                    <h1 class="text-left text-gray-800 dark:text-gray-100 font-lg font-bold tracking-normal leading-tight ml-2">Attach Materials</h1>
                </div>
                
                
                <p class="mb-5 text-sm text-gray-600 dark:text-gray-400 text-left font-normal">Attach from your uploaded materials list</p>
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
                        <option selected>Select a file</option>
                          @foreach ($materials as $material)
                            <option value={{$material->id}}>{{$material->file}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                
                <div class="flex items-center justify-start w-full">
                    <button id="attachMaterial" onclick="attach()" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm ">Save</button>
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
    
  
    <div class="hidden py-12 bg-gray-700 dark:bg-gray-900 transition duration-150 ease-in-out z-10 fixed inset-0 overflow-y-auto" id="deletemodal">
        <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
            <div class="relative py-8 px-8 md:px-16 bg-white dark:bg-gray-800 dark:border-gray-700 shadow-md rounded border border-gray-400">
                
                <div class="w-full flex justify-center text-green-400 mb-4">
                    <img width="56" height="56" src="https://upload.wikimedia.org/wikipedia/commons/d/d9/Warning_sign_font_awesome-red.svg" alt="icon"/>
                    
                </div>
                <h1 tabindex="0" class="focus:outline-none text-center text-gray-800 dark:text-gray-100 font-lg font-bold tracking-normal leading-tight mb-4">Alert!</h1>
                <p tabindex="0" class="focus:outline-none mb-5 text-sm text-gray-600 dark:text-gray-400 text-center font-normal">You're about to delete this lesson page and this action cannot be undone. Are you sure?</p>
                <div class="flex items-center justify-between w-full">
                    <button type="button" onclick="deleteHandler()" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 focus:outline-none transition duration-150 ease-in-out hover:bg-gray-600 bg-gray-400 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm">Cancel</button>
                    <button type="button" onclick="location.href='{{route('deletelesson', [$id, $moduleid,$lessonid])}}'" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 focus:outline-none transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm">Yes</button>
                </div>
                
            </div>
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

    function attach() {
        
        let selectedFile = $('#attach-form').find(":selected").val();
        
        $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
        $.ajax({
            type: "POST",
            data: {selectedFile:JSON.stringify(selectedFile)},
            url: "{{route('attachmaterials', $lessonid)}}",
            
            success: function(response) {
                location.reload();
            },
            error: function(error) {
                console.log(JSON.stringify(error));
            }
        });
    }


    </script>
    <script>
        let deletemodal = document.getElementById("deletemodal");
        function deleteHandler(val) {
        if (val) {
            fadeIn(deletemodal);
        } else {
            fadeOut(deletemodal);
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