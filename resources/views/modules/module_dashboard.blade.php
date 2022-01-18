@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center h-auto items-center space-x-6">
    <div class="w-8/12 bg-white p-6 mt-10 h-full rounded-lg">
        <span>{{$data['name']}}</span>
    </div>
</div>
@endsection