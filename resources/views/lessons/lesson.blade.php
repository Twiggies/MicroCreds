@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center h-auto">
    <div class="flex justify-between w-8/12 h-1/6 bg-white border-3 p-3 mb-3">
        <ul class="flex justify-right">
            <a class="px-3 border-gray-500 border-2" href="{{route('editlesson', $lessonid)}}">Edit</a>
        </ul>
    </div>
</div>
<div id="lessoncontent" class="flex flex-wrap justify-center h-auto">
    
<div class="w-8/12 bg-white p-6 h-full rounded-lg">
    <div>
    {!!$lesson->content!!}
    </div>
</div>
</div>



@endsection
