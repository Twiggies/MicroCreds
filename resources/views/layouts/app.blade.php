<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MicroCreds</title>
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
    <nav class="p-6 bg-white flex justify-between mb-5 rounded-lg">
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
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="p-3 font-semibold">Logout</button>
                </form>
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

@yield('scripts')
</body>
</html>