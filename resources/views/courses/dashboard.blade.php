@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-center">
    <div class="w-8/12 bg-white p-4 rounded-lg font-mono text-2xl font-semibold">
        <span>{{$data['name']}}</span>
        <div class="text-right top-0"> <button >Click Me</button></div>
        
    </div>
    <div class="w-8/12 bg-white p-3 mt-4 h-full rounded-lg border-2 font-mono text-2xl font-semibold">
            
    </div>
    
</div>
@endsection