@extends('layouts.student_app')

@section('content')
    
      
      
<div tabindex="0" class="focus:outline-none">
    <!-- Remove py-8 -->
    <div class="mx-auto container py-8">
        <div>
            <h1 class="font-bold text-4xl text-blue-900">Browse Courses</h1>
        </div>
        <div class="flex flex-wrap items-center ">
            <!-- Card 1 -->
            @foreach ($data as $course)
            <div tabindex="0" class="focus:outline-none mx-2 my-2 w-72 xl:mb-0 mb-8 shadow-md">
                <div>
                    @if ($course->image != null)
                    <img id="image" src="{{asset('storage/images/courses_thumbnail/'.$course->image)}}"
                    tabindex="0" class="focus:outline-none w-full h-44" />
                    @else 
                    <img alt="course stock image" src="https://img.freepik.com/free-vector/students-watching-webinar-computer-studying-online_74855-15522.jpg?t=st=1646212180~exp=1646212780~hmac=8623cbe2b9978c9e95924211171c9d39e45333f62cf51a0fbe509fd8b057465a&w=1380" 
                    tabindex="0" class="focus:outline-none w-full h-44" />
                    @endif
                </div>
                <div class="bg-white">
                    <div class="flex items-center justify-between px-4 pt-4">
                        
                    </div>
                    <div class="p-4">
                        <div class="flex items-center">
                            <h2 tabindex="0" class="focus:outline-none text-xl font-semibold">{{$course->name}}</h2>
                            
                        </div>
                        <p tabindex="0" class="focus:outline-none text-sm text-gray-600 mt-2">{{$course->description}}</p>
                        <div class="flex mt-4">
                            <div>
                                <p tabindex="0" class="focus:outline-none text-gray-600 px-2 text-lg py-1">Duration: <p tabindex="0" class="focus:outline-none text-md text-gray-600 px-2 bg-gray-200 py-1">{{$course->duration}}</p></p>
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