@extends('layouts.student_app')

@section('content')
    
      
      
<div tabindex="0" class="focus:outline-none">
    <!-- Remove py-8 -->
    <div class="mx-auto container py-8">
        <div class="flex flex-wrap items-center lg:justify-between justify-center">
            <!-- Card 1 -->
            @foreach ($data as $course)
            <div tabindex="0" class="focus:outline-none mx-2 w-72 xl:mb-0 mb-8">
                <div>
                    <img alt="person capturing an image" src="https://cdn.tuk.dev/assets/templates/classified/Bitmap (1).png" tabindex="0" class="focus:outline-none w-full h-44" />
                </div>
                <div class="bg-white">
                    <div class="flex items-center justify-between px-4 pt-4">
                        
                    </div>
                    <div class="p-4">
                        <div class="flex items-center">
                            <h2 tabindex="0" class="focus:outline-none text-lg font-semibold">{{$course->name}}</h2>
                            <p tabindex="0" class="focus:outline-none text-xs text-gray-600 pl-5">4 days ago</p>
                        </div>
                        <p tabindex="0" class="focus:outline-none text-xs text-gray-600 mt-2">{{$course->description}}</p>
                        <div class="flex mt-4">
                            <div>
                                <p tabindex="0" class="focus:outline-none text-xs text-gray-600 px-2 bg-gray-200 py-1">Duration</p>
                            </div>
                            <div class="pl-2">
                                <p tabindex="0" class="focus:outline-none text-xs text-gray-600 px-2 bg-gray-200 py-1">{{$course->duration}}</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between py-4">
                            <form action="{{route('detailscourse', ['course_id' => $course->id])}}" method="get">
                                <button tabindex="0" class="mt-5 bg-white transition duration-150 ease-in-out hover:bg-indigo-700 hover:text-white rounded border border-indigo-700 px-3 py-2 focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700 focus:outline-none text-indigo-700 text-xl font-semibold">Details</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 1 Ends -->
            @endforeach
        </div>
            
        <div> 
            {{$data->links()}}
        </div>
    </div>
</div>

@endsection