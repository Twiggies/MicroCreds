@extends('layouts.app')

@section('content')
    <div class="mt-10 justify-center flex flex-col items-center">
        <h1 class="text-center text-4xl font-bold p-2 my-4">Login as Educator</h1>
        <div class="w-3/12 bg-white p-4 rounded-lg ">
            <div class="text-center text-xl mb-6">Login Account</div>
            @if (session('status'))
                <div class="bg-red-400 p-3 rounded-lg mb-3 text-center">
                    {{session('status')}}
                </div>
            @endif
                
            <form action="{{ route('educatorlogin') }}" method="post">
                @csrf

                <div class="my-3 text-center">
                    <label for="email" class="sr-only"></label>
                    <input type="text" name="email" id="email" placeholder="Your Email"
                    class="bg-gray-100 border-2 border-gray-500 p-4 rounded-lg w-full @error('email') border-red-500 @enderror" value="{{old('email')}}">

                    @error('email')
                        <div class="text-red-500 mt-2 text-sm text-left">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="my-3 text-center">
                    <label for="password" class="sr-only"></label>
                    <input type="password" name="password" id="password" placeholder="Your Password"
                    class="bg-gray-100 border-2 border-gray-500 p-4 rounded-lg w-full @error('password') border-red-500 @enderror" value="">

                    @error('password')
                        <div class="text-red-500 mt-2 text-sm text-left">
                            {{ $message }}
                        </div>                        
                    @enderror
                </div>
                <div onclick="location.href='{{route('educatorregister')}}'"class="cursor-pointer my-3 text-left underline text-blue-500 hover:text-blue-600">
                    Don't have an account? Sign up here.
                </div>
                <div class="my-4 text-center">
                    <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-3 rounded rounded font-large w-auto">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection