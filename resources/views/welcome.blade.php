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
<body class="bg-gray-100">
    <div class="mt-40 place-content-center">
        <p class="text-6xl text-center mb-10">MicroLearn</p>
        <div class="grid grid-rows-3 grid-cols-7 gap-2">
            <div class=" col-start-3 col-end-4 h-80 bg-gray-300 text-center float-left p-5 ml-3 rounded-lg">
                <div class="text-4xl mb-3">Educator</div>
                <div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white text-2xl p-3 w-full font-bold py-2 px-4 rounded my-10" onclick="window.location.href='{{url('educatorregister')}}'">
                        Register
                </button>
                </div>
                <div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white text-2xl p-3 w-full font-bold py-2 px-4 rounded" onclick="window.location.href='{{route('educatorlogin')}}'">
                        Login
                </button>
                </div>
            </div>
            <div class="flex-auto col-start-5 col-end-6 bg-gray-300 text-center float-left p-5 ml-3 rounded-lg">
                <div class="text-4xl mb-3">Learner</div>
                <div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white text-2xl p-3 w-full font-bold py-2 px-4 rounded my-10" onclick="window.location.href='{{route('studentregister')}}'">
                        Register
                </button>
                </div>
                <div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white text-2xl p-3 w-full font-bold py-2 px-4 rounded" onclick="window.location.href='{{route('studentlogin')}}'">
                        Login
                </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>