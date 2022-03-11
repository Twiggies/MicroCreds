@extends('layouts.student_app')

@section('content')
    
<div class="dark:bg-gray-900">
    <div class="mx-auto container w-full flex items-center md:flex-row flex-col justify-between px-6 lg:px-0">
      <div class="flex flex-col justify-start items-start lg:w-2/5 px-2 lg:px-0">
        <div>
            <p class="text-gray-800 dark:text-white lg:text-4xl text-3xl font-extrabold leading-9">{{$course->name}}</p>
        </div>
        <div class="flex justify-center items-center mt-10 ">
            <img class="w-full" src="https://img.freepik.com/free-vector/students-watching-webinar-computer-studying-online_74855-15522.jpg?t=st=1646212180~exp=1646212780~hmac=8623cbe2b9978c9e95924211171c9d39e45333f62cf51a0fbe509fd8b057465a&w=1380"
             alt="laptops" />
        </div>
      </div>
      <div class="flex justify-center lg:w-2/5 mt-10 md:mt-0">
            
        <div class="relative mt-16 items-stretch">
            <div class="rounded overflow-hidden shadow-md bg-white">
                <div class="absolute -mt-32 w-full flex justify-center">
                <h1 class="font-bold text-3xl text-center mb-1">Your Educator</h1>
                </div>
                <div class="absolute -mt-20 w-full flex justify-center">
                    <div class="h-32 w-32">
                      @if ($educator_profile->picture != null)
                        <img src="{{asset('storage/images/profile/'.$educator_profile->user_id.'/'.$educator_profile->picture)}}" alt="Educator Picture" role="img" class="rounded-full object-cover h-full w-full shadow-md" />
                      @else 
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg" alt="Educator Picture" role="img" class="rounded-full object-cover h-full w-full shadow-md">
                      @endif
                    </div>
                </div>
                <div class="px-6 mt-16">
                    <h1 class="font-bold text-3xl text-center mb-1">{{$educator->firstname.' '.$educator->lastname}}</h1>
                    <p class="text-gray-800 text-sm text-center">Product Design Head</p>
                    <hr>
                    <p class="text-center text-gray-600 text-base pt-3 font-normal text-3xl">About</p>
                    <div class="w-full flex justify-center pt-5 pb-5">
                      {{$educator_profile->about}}
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="mx-auto container w-full flex xl:flex-row flex-col justify-between items-start mt-12 px-6 lg:px-0">
      <div class="flex flex-col justify-start items-start xl:w-2/4">
        <div>
          <h2 class="text-gray-800 dark:text-white lg:text-3xl text-2xl font-bold leading-7">Description</h2>
        </div>
        <div class="mt-5">
          <p class="text-gray-800 dark:text-white lg:text-base text-sm leading-normal">
             {{$course->description}}
          </p>
        </div>
        <div class="mt-8 flex justify-start items-start flex-col">
          <div>
            <p class="text-gray-800 dark:text-white lg:text-base text-sm font-semibold leading-none">Estimated Duration of Course</p>
          </div>
          <div class="text-gray-800 dark:text-white mt-4 lg:text-base text-sm leading-normal">
            <ul>
              <li class="flex justify-start items-start space-x-1 flex-row">
                <div>-</div>
                <div>Mauris ullamcorper neque sed mauris gravida, vel mollis velit molestie.</div>
              </li>
              <li class="flex justify-start items-start space-x-1 flex-row">
                <div>-</div>
                <div>Donec iaculis erat in vulputate venenatis.</div>
              </li>
              <li class="flex justify-start items-start space-x-1 flex-row">
                <div>-</div>
                <div>Vestibulum et velit et metus commodo iaculis.</div>
              </li>
              <li class="flex justify-start items-start space-x-1 flex-row">
                <div>-</div>
                <div>Sed et urna a felis accumsan commodo vel vel nibh.</div>
              </li>
              <li class="flex justify-start items-start space-x-1 flex-row">
                <div>-</div>
                <div>Praesent sollicitudin nulla non sollicitudin varius.</div>
              </li>
              <li class="flex justify-start items-start space-x-1 flex-row">
                <div>-</div>
                <div>Integer convallis orci sed diam volutpat feugiat.</div>
              </li>
              <li class="flex justify-start items-start space-x-1 flex-row">- Donec posuere arcu non semper maximus.</li>
            </ul>
          </div>
        </div>
      </div>
      
      <div class="px-4 lg:px-16 mt-10 xl:mt-0 h-full xl:w-2/5 w-full flex justify-center items-center bg-gradient-to-l from-indigo-600 to-indigo-700">
        
        <div class="flex flex-col lg:justify-start justify-center lg:items-start items-center my-10">
          <div class=" justify-start items-center space-x-4 w-full">
            @if (Auth::user()->enrolls->where('course_id', $course->id)->first())
            <form action="{{route('viewcourse', ['id' => $course->id])}}" method="get">
              @csrf
                <button class="w-40 btn focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800 text- lg:text-base border border-white py-2 px-4 md:py-4 md:px-8 text-white rounded-sm hover:bg-white hover:text-indigo-700">Go to Course</button>
            </form>
            @else
              <form action="{{route('enroll', ['course_id' => $course->id])}}" method="post">
                @csrf
                  <button class="w-40 btn focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800 text- lg:text-base border border-white py-2 px-4 md:py-4 md:px-8 text-white rounded-sm hover:bg-white hover:text-indigo-700">Enroll</button>
              </form>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
 

@endsection