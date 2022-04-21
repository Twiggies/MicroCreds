@extends('admin.layout')

@section('content')
<h1 class="text-3xl text-black pb-6">{{$course->name}}</h1>
<div class="flex flex-wrap sm:flex-no-wrap items-start justify-between w-full">
    
    <div class="w-full sm:w-3/4 h-full shadow bg-white dark:bg-gray-800 p-2">
        <div class="flex flex-col justify-start items-start lg:w-1/5 px-2 lg:px-0">
            <div class="flex justify-center items-center border p-0">
            @if ($course->image != null)
            <img id="image" src="{{asset('storage/images/courses_thumbnail/'.$course->image)}}"
            tabindex="0" class="focus:outline-none w-auto h-auto" />
            @else 
            <img alt="course stock image" src="https://img.freepik.com/free-vector/students-watching-webinar-computer-studying-online_74855-15522.jpg?t=st=1646212180~exp=1646212780~hmac=8623cbe2b9978c9e95924211171c9d39e45333f62cf51a0fbe509fd8b057465a&w=1380" 
            tabindex="0" class="focus:outline-none w-full h-auto" />
            @endif
            </div>
        </div>
        <div class="flex flex-col">
            <label for="institute" class="block text-xl font-medium text-gray-700"> Course Name </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  
                  <input disabled type="text" name="institute" id="institute" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm 
                  border-gray-300"
                  value="{{$course->name}}"
                  >
                </div>
        </div>
        <div class="flex flex-col">
            <label for="institute" class="block text-xl font-medium text-gray-700"> Course Description</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  
                  <textarea disabled type="text" name="institute" id="institute" rows="7" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm 
                  border-gray-300"
                  
                  >{{$course->description}}</textarea>
                </div>
        </div>
        <div class="flex flex-col">
            <label for="institute" class="block text-xl font-medium text-gray-700"> Course Duration</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  
                    <input disabled type="text" name="institute" id="institute" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm 
                    border-gray-300"
                    value="{{$course->duration}}"
                    >
                </div>
        </div>
        @php
                    $newdate = strtotime($course->created_at);
                    $course_date = date('M d, Y', $newdate);
        @endphp
        <div class="flex flex-col">
            <label for="institute" class="block text-xl font-medium text-gray-700"> Date Created</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  
                    <input disabled type="text" name="institute" id="institute" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm 
                    border-gray-300"
                    value="{{$course_date}}"
                    >
                </div>
        </div>
    </div>
    <div class="w-full sm:w-1/4 h-full rounded-b sm:rounded-b-none shadow bg-white dark:bg-gray-800">
        <div>
        <div class="bg-blue-300">
            <div class="justify-center">
            <h1 class="font-bold text-3xl text-center mb-1">Educator Details</h1>
            </div>
            <div class="w-full flex justify-center">
                <div class="h-32 w-32">
                  @if ($educator_profile)
                    @if ($educator_profile->picture != null)
                      <img src="{{asset('storage/images/profile/'.$educator_profile->user_id.'/'.$educator_profile->picture)}}" alt="Educator Picture" role="img" class="rounded-full object-cover h-full w-full shadow-md" />
                    @else
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg" alt="Educator Picture" role="img" class="rounded-full object-cover h-full w-full shadow-md">
                    @endif
                  @else 
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg" alt="Educator Picture" role="img" class="rounded-full object-cover h-full w-full shadow-md">
                  @endif
                </div>
               
            </div>
        
            <h1 class="mt-6 p-2 font-bold text-3xl text-center mb-1">{{$educator->firstname.' '.$educator->lastname}}</h1>
        </div>
        <hr>
            <div class="px-6 mt-6 ">
                
                <p class="text-center text-gray-600 text-base pt-3 font-normal text-3xl">Date Account Created</p>
                <div class="w-full flex justify-center py-3 text-2xl border-2">
                @php
                    $newdate = strtotime($educator->created_at);
                    $date = date('M d, Y', $newdate);
                @endphp
                {{$date}}
                </div>
                @php
                    $count = App\Models\Course::where('user_id', $educator->id)->get()->count();    
                @endphp
                <p class="text-left text-gray-600 text-base mt-10 pt-3 font-normal text-2xl">Courses Created: {{$count}}</p>
                @php
                    $published_count = App\Models\Course::where('user_id', $educator->id)->where('status', 'published')->get()->count();    
                @endphp
                <p class="flex text-left text-gray-600 text-base mt-5 pt-3 font-normal text-2xl">Courses Published: {{$published_count}}</p>
            </div>
        </div>
    </div>
    
</div>
<div class="pt-2 relative mx-auto text-gray-600">
    <button onclick="location.href='{{route('approvecourse',['course_id' => $course->id])}}'"
        class="absolute right-0 bg-blue-500 text-white px-3 py-2 rounded-md text-md font-medium hover:bg-blue-700 transition duration-300">Approve</button>
</div>
@endsection