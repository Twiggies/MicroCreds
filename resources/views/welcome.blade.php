<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MicroLearn</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body class="h-screen">
    
    <div class="h-full bg-gradient-to-tl from-green-400 to-blue-200 w-full py-16 px-4">
        <div class="flex flex-col h-full items-center justify-center">
           <img class="h-64 w-64" src="{{asset('public/54a71fdd2b6645b694cae74f8c22c66a.png')}}" alt="logo">

           @if (session('message'))
            <div class="font-semibold p-3 text-2xl rounded-lg my-3">
                {{session('message')}}
            </div>
           @endif
            <div class="bg-white shadow rounded lg:w-1/3  md:w-1/2 w-full p-10 mt-16">
                <p tabindex="0" class="focus:outline-none text-center text-2xl font-extrabold leading-6 text-gray-800">Login to your account</p>
                
                <button onclick="location.href='{{route('educatorlogin')}}'" aria-label="Continue with google" role="button" class="hover:text-white hover:bg-blue-400 text-xl font-medium hover:border-blue-400 text-gray-700 transition duration-200 text-center focus:outline-none  focus:ring-2 focus:ring-offset-1 focus:ring-gray-700 py-3.5 px-4 border rounded-lg border-gray-700 flex items-center w-full mt-4">
                   
                    Login as Educator
                </button>
                <button onclick="location.href='{{route('studentlogin')}}'" aria-label="Continue with github" role="button" class="hover:text-white hover:bg-blue-400 text-xl font-medium hover:border-blue-400 text-gray-700 transition duration-200 text-center focus:outline-none  focus:ring-2 focus:ring-offset-1 focus:ring-gray-700 py-3.5 px-4 border rounded-lg border-gray-700 flex items-center w-full mt-4">
                                             
                    Login as Student
                </button>
                
            </div>
        </div>
    </div>
    
</body>
</html>