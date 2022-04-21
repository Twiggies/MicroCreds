@extends('layouts.app')

@section('content')
    <!-- component -->
<div class="flex justify-center min-h-screen bg-gray-100 antialiased">  
    <div class="container sm:mt-40 mt-24 my-auto max-w-md border-2 border-gray-200 p-3 bg-white">
      <!-- header -->  
      <div class="text-center m-6">
        <h1 class="text-3xl font-semibold text-gray-700">Reset password</h1>
      </div>
      @if (session('message'))
        <div class="alert alert-success" role="alert">
        {{ session('message') }}
        </div>
      @endif
      <!-- sign-in -->
      <div class="m-6">
        <form class="mb-4" action="{{route('resetpassword.post')}}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Email</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                @error('email')
                            <div class="text-red-500 mt-2 text-sm text-left">
                                {{ $message }}
                            </div>
                @enderror
            </div>  
          <div class="mb-6">
            <label for="password" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Password</label>
            <input type="password" name="password" id="password" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
            @error('password')
                        <div class="text-red-500 mt-2 text-sm text-left">
                            {{ $message }}
                        </div>
            @enderror
        </div>
        <div class="mb-6">
            <label for="password-confirm" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password-confirm" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
            @error('password-confirm')
                        <div class="text-red-500 mt-2 text-sm text-left">
                            {{ $message }}
                        </div>
            @enderror
        </div>
          <div class="mb-6">
            <button type="submit" class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none duration-100 ease-in-out">Reset Password</button>
          </div>
        </form>
        
        
      </div>
    </div>
  </div>
@endsection