@extends('layouts.student_app')

@section('content')
    
<div class="dark:bg-gray-900">
    <div class="mx-auto container w-full flex items-center md:flex-row flex-col justify-between px-6 lg:px-0">
      <div class="flex flex-col justify-start items-start lg:w-2/5 px-2 lg:px-0">
        <div>
            <p class="text-gray-800 dark:text-white lg:text-4xl text-3xl font-extrabold leading-9">{{$course->name}}</p>
        </div>
        <div class="flex justify-center items-center mt-10 ">
            <img class="w-full" src="https://i.ibb.co/181DvLN/Project-Cover-6.png" alt="laptops" />
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
                        <img src="https://cdn.tuk.dev/assets/photo-1530577197743-7adf14294584.jfif" alt="Display Picture of Silene Tokyo" role="img" class="rounded-full object-cover h-full w-full shadow-md" />
                    </div>
                </div>
                <div class="px-6 mt-16">
                    <h1 class="font-bold text-3xl text-center mb-1">Silene Tokyo</h1>
                    <p class="text-gray-800 text-sm text-center">Product Design Head</p>
                    <p class="text-center text-gray-600 text-base pt-3 font-normal">The emphasis on innovation and technology in our companies has resulted in a few of them establishing global benchmarks in product design and development.</p>
                    <div class="w-full flex justify-center pt-5 pb-5">
                        
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
            <p class="text-gray-800 dark:text-white lg:text-base text-sm font-semibold leading-none">Breakdown of milestones</p>
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
              <form action="{{route('enroll', ['course_id' => $course->id])}}" method="post">
                @csrf
                  <button class="w-40 btn focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800 text- lg:text-base border border-white py-2 px-4 md:py-4 md:px-8 text-white rounded-sm hover:bg-white hover:text-indigo-700">Enroll</button>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
 

@endsection