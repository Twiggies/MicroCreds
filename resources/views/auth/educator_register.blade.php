@extends('layouts.app')

@section('content')
    <div class="mt-10 justify-center flex flex-col items-center">
        <h1 class="text-center text-4xl font-bold p-2 my-4">Register as Educator</h1>
        <div class="w-3/12 bg-white p-4 rounded-lg">
            <div class="text-center text-xl">Register Account</div>
            @if (session('status'))
                <div class="bg-red-400 p-3 rounded-lg mb-3 text-center">
                    {{session('status')}}
                </div>
            @endif
            <form action="{{ route('educator_register_request') }}" method="post">
                @csrf
                <div class="my-3 text-center">
                    <label for="firstname" class="sr-only">First Name</label>
                    <input type="text" name="firstname" id="firstname" placeholder="Your First Name"
                    class="bg-gray-100 border-2 border-gray-500 p-4 rounded-lg w-full @error('firstname') border-red-500 @enderror" value="{{old('firstname')}}">
                    
                    @error('firstname')
                        <div class="text-red-500 mt-2 text-sm text-left">
                            {{ $message }}
                        </div>                        
                    @enderror
                </div>

                <div class="my-3 text-center">
                    <label for="lastname" class="sr-only">Last Name</label>
                    <input type="text" name="lastname" id="lastname" placeholder="Your Last Name"
                    class="bg-gray-100 border-2 border-gray-500 p-4 rounded-lg w-full @error('lastname') border-red-500 @enderror" value="{{old('lastname')}}">
                    
                    @error('lastname')
                        <div class="text-red-500 mt-2 text-sm text-left">
                            {{ $message }}
                        </div>                        
                    @enderror
                </div>

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
                
                <div class="my-4 text-center">
                    <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-3 rounded rounded font-large w-auto">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection