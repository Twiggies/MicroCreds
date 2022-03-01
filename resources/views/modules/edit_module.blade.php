@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center h-auto items-center">
    <div class="w-8/12 bg-white p-6 mt-10 h-full rounded-lg">
        <div>
            <form action="{{route('editmodule', [$id, $moduleid])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <span>Module Name</span>
                        <input type="text" name="modulename" id="modulename"
                        class="bg-gray-100 border-2 border-gray-500 p-4 rounded-lg w-full @error('modulename') border-red-500 @enderror" value="{{$module->name}}">
                        @error('modulename')
                            <div class="text-red-500 mt-2 text-sm text-left">
                                {{ $message }}
                            </div>                        
                        @enderror
                </div>
                
                <div>
                <span>Description</span>
                        <textarea  name="description" id="description"
                        class="bg-gray-100 border-2 border-gray-500 p-4 rounded-lg w-full h-128 @error('description') border-red-500 @enderror" value="">{{$module->description}}</textarea>
                        @error('description')
                            <div class="text-red-500 mt-2 text-sm text-left">
                                {{ $message }}
                            </div>                        
                        @enderror
                </div>
                <div class="my-4 text-right">
                    <a href="{{url()->previous()}}" class="btn btn-default underline">Cancel</a>
                    <button type="submit" class="bg-green-400 text-white font-bold p-2 rounded rounded font-large w-auto">
                        Update
                    </button>
                </div>
              </form>
            </div>
    </div>
</div>
@endsection