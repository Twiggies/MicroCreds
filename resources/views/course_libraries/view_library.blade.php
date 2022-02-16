@extends('layouts.app')

@section('content')
<div class="md:grid md:grid-cols-4 md:gap-6">
    <div class="mt-5 md:mt-0 md:col-span-2 md:col-start-2  ">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="md:grid md:grid-cols-2  px-4 py-5 bg-white sm:p-6">
                <div class="md:col-span-1">
                    <span class=" text-2xl font-semibold text-gray-700">{{$library->name}}</span>
                </div>
                <div class="md:col-span-1 text-right">
                    <button class="focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 focus:bg-gray-400 hover:bg-gray-400 focus:text-white hover:text-white font-normal bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-indigo-600 focus:outline-none transition duration-150 
                    ease-in-out hover:bg-gray-300 rounded text-indigo-600 px-6 py-2 text-sm">Options</button>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="mt-5 md:grid md:grid-cols-8 md:gap-5">
    <div class="md:mt-0 md:col-span-6 md:col-start-3 ">
        <div class="w-8/12 bg-white p-3 mt-4 h-full rounded-lg border-2 font-mono text-2xl font-semibold">
            
        </div>
    </div>
</div>
@endsection