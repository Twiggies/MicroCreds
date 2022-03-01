@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center h-auto">
<div class="w-8/12 bg-white p-6 h-full rounded-lg">
   
    <div class="flex justify-between w-8/11 bg-white p-6 h-full rounded-lg">
         <ul class="flex items-right">
            <a class="mx-2 my-2 bg-white transition duration-150 ease-in-out hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-6 py-2 text-lg focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700" href="{{route('managequiz', $lessonid)}}">Manage Quiz</a>
            <button onclick="modalHandler(true)" class="mx-2 my-2 bg-white transition duration-150 ease-in-out hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-6 py-2 text-lg focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700">Attach Materials</button>
         </ul>
    </div> 
    <form action="{{route('updatelesson', [$id, $moduleid, $lessonid])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div>
    
    
    <input type="text" name="lessonname" id="lessonname"
        class="bg-gray-100 border-2 border-gray-500 p-2 rounded-lg w-1/4 @error('lessonname') border-red-500 @enderror" value="{{$lesson->name}}">
        @error('lessonname')
                    <div class="text-red-500 mt-2 text-sm text-left">
                        {{ $message }}
                    </div>
         @enderror
    </div>
    @foreach ($materials as $material)
    <div>{{$material->file}}</div>
    @endforeach
    <div class="w-full bg-white p-6 mt-3 h-full rounded-lg">
        <textarea id="summernote" name="content">{!!$lesson->content!!}</textarea>
            <div>
                <div class="my-4 text-right">
                    <a href="{{url()->previous()}}" class="btn btn-default underline">Cancel</a>
                    <button type="submit" class="bg-green-400 text-white font-bold p-2 rounded font-large w-auto">
                        Save
                    </button>
                </div>
            </div>
        
    </div>
    </form>
    

    <div class="hidden py-12 bg-gray-700 dark:bg-gray-900 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0" id="modal">
        <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
            <div class="relative p-4 md:p-8 bg-white dark:bg-gray-800 shadow-md rounded border border-gray-400">
                <div aria-label="upload icon" role="img" class="w-full flex items-center justify-start text-gray-600 dark:text-gray-400 mb-5">
                    <img class="dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/left_aligned_file_upload-svg1.svg" alt="icon"/>
                    <img class="hidden dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/left_aligned_file_upload-svg1dark.svg" alt="icon"/>
                    
                    <h1 class="text-left text-gray-800 dark:text-gray-100 font-lg font-bold tracking-normal leading-tight ml-2">Attach Materials</h1>
                </div>
                <p class="mb-5 text-sm text-gray-600 dark:text-gray-400 text-left font-normal">Upload from your computer</p>
                <div class="flex items-center justify-start w-full mb-8 border border-dashed border-indigo-700 rounded-lg p-3">
                    <div class="cursor-pointer text-indigo-700 dark:text-indigo-600">
                        <img class="dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/left_aligned_file_upload-svg3.svg" alt="icon"/>
                       <img class="hidden dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/left_aligned_file_upload-svg3dark.svg" alt="icon"/>
                       
                    </div>
                    <p class="text-base font-normal tracking-normal text-gray-800 dark:text-gray-100 text-left ml-4">
                        
                        <a href="javascript:void(0)" class="cursor-pointer text-indigo-700 dark:text-indigo-600">Browse</a>
                    </p>
                </div>
                <div class="flex justify-between items-center w-full"> 
                    <p class="mb-5 text-md text-gray-600 dark:text-gray-400 text-left font-normal">OR</p>
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
    })
}
    </script>
@endsection