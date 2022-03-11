<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MicroLearn</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/qib9yrcvw9x597pkdx1i2c72x475cugi85q97zsff3kvwh6x/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
          selector: '#tinymce',
          plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker image',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table image',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      height: "600"
        });
      </script>
</head>
<body class="bg-gray-100">
    <div id="app">
    <nav class="p-6 bg-gray-800 text-white  flex justify-between mb-5">
        <ul class="flex items-center font-semibold">
            @if (auth()->user())
            <li>
                <a href="{{route('dashboard')}}" class="p-3">Home</a>
            </li>
            @else
            <li>
                <a href="{{route('home')}}" class="p-3">Home</a>
            </li>
            @endif
        </ul>
        <ul class="flex items-center font-semibold">
            @if (auth()->user())
            <li>
                <button aria-label="dropdown" class="focus:outline-none border-b-2 border-transparent focus:border-white py-3  focus:text-indigo-700 text-gray-600 hover:text-indigo-700 flex items-center relative" onclick="dropdownHandler(this)">
                    <ul class="hidden p-2 w-40 border-r bg-white rounded right-0 shadow top-0 mt-16 absolute z-50">
                        <li onclick="location.href='{{route('myprofile')}}'" class="cursor-pointer text-gray-600 text-sm leading-3 tracking-normal py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none">
                            <a href="{{route('myprofile')}}" class="focus:underline focus:text-indigo-700 focus:outline-none flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                </svg>
                                <span class="ml-2">My Profile</span>
                            </a>
                        </li>
                        <li onclick="location.href='{{route('createdcourses')}}'" class="cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mt-2 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none flex items-center">
                            <a href="{{route('createdcourses')}}" class="focus:underline focus:text-indigo-700 focus:outline-none flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-help" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <line x1="12" y1="17" x2="12" y2="17.01"></line>
                                <path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4"></path>
                            </svg>
                            <span class="ml-2">My Courses</span>
                        </a>
                        </li>
                        <li onclick="location.href='{{route('materials')}}'" class="cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mt-2 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none flex items-center">
                            <a href="{{route('materials')}}" class="focus:underline focus:text-indigo-700 focus:outline-none flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-help" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <line x1="12" y1="17" x2="12" y2="17.01"></line>
                                <path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4"></path>
                            </svg>
                            <span class="ml-2">My Materials</span>
                        </a>
                        </li>
                        <li onclick="location.href='{{route('courselibraries')}}'" class="cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mt-2 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none flex items-center">
                            <a href="{{route('courselibraries')}}" class="focus:underline focus:text-indigo-700 focus:outline-none flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-help" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <line x1="12" y1="17" x2="12" y2="17.01"></line>
                                <path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4"></path>
                            </svg>
                            <span class="ml-2 text-xs">My Course Libraries</span>
                        </a>
                        </li>
                        <li class="cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mt-2 py-2 hover:text-indigo-700 flex items-center focus:text-indigo-700 focus:outline-none">
                            <a href="javascript:void(0)" class="focus:underline focus:text-indigo-700 focus:outline-none flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <span class="ml-2">Change Password</span>
                            </a>
                        </li>
                        <li onclick="location.href='{{route('logout')}}'" class="cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mt-2 py-2 hover:text-indigo-700 flex items-center focus:text-indigo-700 focus:outline-none">
                            <a href="{{route('logout')}}" class="focus:underline focus:text-indigo-700 focus:outline-none flex items-center">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="none" stroke="#231F20" stroke-width="2" d="M13,9 L13,2 L1,2 L1,22 L13,22 L13,15 M22,12 L5,12 M17,7 L22,12 L17,17"/>
                                  </svg>
                            <span class="ml-2">
                                    Logout
                            </span>
                            </a>
                        </li>
                    </ul>
                    <div class="cursor-pointer flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-white transition duration-150 ease-in-out">
                        
                    @php
                        $profile = App\Models\Profile::where('user_id', auth()->user()->id)->first()
                    @endphp
                    @if ($profile != null)
                       @php
                           $picture = $profile->picture;
                       @endphp
                        @if ($picture != null)
                        <img class="rounded-full h-10 w-10 object-cover" src="{{asset('storage/images/profile/'.auth()->user()->id.'/'.$picture)}}" alt="logo">
                        @else
                        <img class="rounded-full h-10 w-10 object-cover" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg" alt="logo">
                        @endif
                    @else
                    <img class="rounded-full h-10 w-10 object-cover" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg" alt="logo">
                    @endif
                    </div>
                    <div class="ml-2 text-white">
                        {{ucfirst(Auth::user()->firstname)}}
                    </div>
                    <div class="ml-2 ">
                        <img class="icon icon-tabler icon-tabler-chevron-down cursor-pointer" width="20" height="20" src="https://upload.wikimedia.org/wikipedia/commons/e/ee/Chevron-down.svg" alt="chevron down">
                    </div>
                </button>
            </li>
            @else
            <li>
                <form action="{{route('educatorlogin')}}" method="GET">
                    @csrf
                    <button class="p-3 font-semibold">Login</button>
                </form>
            </li>
            @endif
            
        </ul>
    </nav>
    <div>
    @yield('content')
    </div>
    </div>
<script src="{{mix('/js/app.js')}}"></script>
<script>
    $('#summernote').summernote({
      placeholder: 'New Lesson',
      tabsize: 2,   
      height: 600,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  </script>
  <script>
    $(document).ready(function(){
            $("#lessoncontent ul").addClass('list-disc');
            $("#lessoncontent ol").addClass('list-decimal');
          });
</script>
<script>
    function dropdownHandler(element) {
    let single = element.getElementsByTagName("ul")[0];
    single.classList.toggle("hidden");
}
</script>
@yield('scripts')
</body>
</html>