@extends('layouts.app')

@section('content')
<div id="lessoncontent" class="flex flex-wrap justify-center h-auto">
<div class="w-8/12 bg-white p-6 h-full rounded-lg">
    <div>
    {!!$lesson->content!!}
    </div>
</div>
</div>



@endsection
