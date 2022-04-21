@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center h-auto items-center space-x-6">
    <div class="w-8/12 bg-white p-6 mt-10 h-full rounded-lg">
        <div>
            <form action="{{route('addnewmodule', compact('id'))}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="my-3">
                    <span>Module Name</span>
                        <input type="text" name="modulename" id="modulename"
                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm 
                        border-gray-300 @error('modulename') border-red-500 @enderror" value="{{old('modulename')}}">
                        @error('modulename')
                            <div class="text-red-500 mt-2 text-sm text-left">
                                {{ $message }}
                            </div>                        
                        @enderror
                </div>
                
                <div>
                <span>Description</span>
                        <textarea  name="description" id="description"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md @error('description') border-red-500 @enderror" value="{{old('description')}}"></textarea>
                        @error('description')
                            <div class="text-red-500 mt-2 text-sm text-left">
                                {{ $message }}
                            </div>                        
                        @enderror
                </div>
                <div class="my-4 text-right">
                    <a href="{{route('courselibraries')}}" class="btn btn-default underline">Cancel</a>
                    <button type="submit" class="inline-flex justify-center p-2 border border-transparent shadow-sm text-lg font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Create
                    </button>
                </div>
              </form>
            </div>
    </div>
</div>
@endsection