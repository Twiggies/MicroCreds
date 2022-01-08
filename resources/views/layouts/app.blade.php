<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MicroCreds</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


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
        <ul class="flex items-center">
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
    @yield('content')
</div>
<script src="{{mix('/js/app.js')}}"></script>
</body>
</html>