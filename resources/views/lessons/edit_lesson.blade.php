@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center h-auto">
<div class="w-8/12 bg-white p-6 h-full rounded-lg">
    <form action="{{route('updatelesson', $lessonid)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="flex justify-between w-8/11 bg-white p-6 h-full rounded-lg">
        <input type="text" name="lessonname" id="lessonname"
        class="bg-gray-100 border-2 border-gray-500 p-2 rounded-lg w-1/4 @error('lessonname') border-red-500 @enderror" value="{{$lesson->name}}">
        @error('lessonname')
                    <div class="text-red-500 mt-2 text-sm text-left">
                        {{ $message }}
                    </div>
         @enderror
         <ul class="flex items-right">
            <a class="px-3 border hover:bg-blue-500 hover:text-white border-gray-500" href="{{route('managequiz', $lessonid)}}">Manage Quiz</a>
            <a class="px-3 border hover:bg-blue-500 hover:text-white border-gray-500" href="">Attach Materials</a>
         </ul>
    </div> 

    <div class="w-full bg-white p-6 mt-3 h-full rounded-lg">
        <textarea id="summernote" name="content">{!!$lesson->content!!}</textarea>
            <div>
                <div class="my-4 text-right">
                    <a href="{{url()->previous()}}" class="btn btn-default underline">Cancel</a>
                    <button type="submit" class="bg-green-400 text-white font-bold p-2 rounded font-large w-auto">
                        Save
                    </button>
                </div>
            </div>
        
    </div>
    </form>
</div>
</div>

@endsection

