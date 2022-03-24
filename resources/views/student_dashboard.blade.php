@extends('layouts.student_app')

@section('content')
    <div class="flex flex-wrap justify-center h-96">
        <div class="w-10/12 bg-white p-6 rounded-lg font-mono text-2xl font-semibold">
            Welcome, {{ucfirst(auth()->user()->firstname)}}
        </div>
        <!-- component -->
<link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />

<!-- ====== Pricing Section Start -->
<section
   class="
   bg-white
   pt-10
   my-10
   lg:pt-[120px]
   pb-12
   lg:pb-[90px]
   relative
   z-20
   overflow-hidden
   "
   >
   <div class="container">
      
      <div class="flex flex-wrap justify-center -mx-4">
         <div class="h-1/2 md:h-1/2 lg:h-1/3 w-full md:w-1/2 lg:w-1/3 px-4">
            <div
               class="
               
               bg-white
               rounded-xl
               relative
               z-10
               overflow-hidden
               border border-primary border-opacity-20
               shadow-pricing
               
               mb-10
               "
               >
               
               <p
                  class="
                  text-base text-body-color
                  w-full
                  border-b border-[#F2F2F2]
                  "
                  >
                  <img src="https://media.istockphoto.com/photos/school-picture-id1016131800?b=1&k=20&m=1016131800&s=612x612&w=0&h=GGIw22ciOn7UckwP6jTAkf44TUAW2XY8Ev8516W7gro=">
               </p>
               <div class="py-10
               px-8
               sm:p-12
               lg:py-10 lg:px-6
               xl:p-12">
               <div class="mb-7 pb-10">
                <p class="text-3xl font-semibold text-center text-body-color leading-loose mb-1">
                    Browse Courses
                </p>
                  <p class="text-base text-body-color leading-loose mb-1">
                     Discover and enroll new courses
                  </p>
                  
               </div>
               <a
                  href="{{route('browsecourses')}}"
                  class="
                  
                  w-full
                  block
                  text-base
                  font-semibold
                  text-primary
                  bg-transparent
                  border border-[#D4DEFF]
                  rounded-md
                  text-center
                  p-4
                  hover:text-white hover:bg-primary hover:border-primary
                  transition
                  "
                  >
               Start browsing
               </a>
            </div>
               
            </div>
         </div>
         <div class="h-1/2 md:h-1/2 lg:h-1/3 w-full md:w-1/2 lg:w-1/3 px-4">
            <div
               class="
               bg-white
               rounded-xl
               relative
               z-10
               overflow-hidden
               border border-primary border-opacity-20
               shadow-pricing
               h-full
               mb-10
               "
               >
               
               <p
                  class="
                  text-base text-body-color
                  w-full
                  border-b border-[#F2F2F2]
                  "
                  >
                  <img src="https://media.istockphoto.com/photos/school-picture-id1016131800?b=1&k=20&m=1016131800&s=612x612&w=0&h=GGIw22ciOn7UckwP6jTAkf44TUAW2XY8Ev8516W7gro=">
               </p>
               <div class="py-10
               px-8
               sm:p-12
               lg:py-10 lg:px-6
               xl:p-12">
               <div class="mb-7 pb-10">
                <p class="text-3xl font-semibold text-center text-body-color leading-loose mb-1">
                    Enrolled Courses
                </p>
                  <p class="text-base text-body-color leading-loose mb-1">
                     All of your enrolled courses.
                  </p>
                  
               </div>
               <a
                  href="{{route('enrolledcourses')}}"
                  class="
                  
                  w-full
                  block
                  text-base
                  font-semibold
                  text-primary
                  bg-transparent
                  border border-[#D4DEFF]
                  rounded-md
                  text-center
                  p-4
                  hover:text-white hover:bg-primary hover:border-primary
                  transition
                  "
                  >
               Go to your courses
               </a>
            </div>
               
            </div>
         </div>
         <div class="w-full md:w-1/2 lg:w-1/3 px-4">
            <div
               class="
               bg-white
               rounded-xl
               relative
               z-10
               overflow-hidden
               border border-primary border-opacity-20
               shadow-pricing
               
               mb-10
               "
               >
               
               <p
                  class="
                  text-base text-body-color
                  w-full
                  border-b border-[#F2F2F2]
                  "
                  >
                  <img src="https://media.istockphoto.com/photos/school-picture-id1016131800?b=1&k=20&m=1016131800&s=612x612&w=0&h=GGIw22ciOn7UckwP6jTAkf44TUAW2XY8Ev8516W7gro=">
               </p>
               <div class="py-10
               px-8
               sm:p-12
               lg:py-10 lg:px-6
               xl:p-12">
               <div class="mb-7 pb-10">
                <p class="text-3xl font-semibold text-center text-body-color leading-loose mb-1">
                    Your Earned Credentials
                </p>
                  <p class="text-base text-body-color leading-loose mb-1">
                     All of your earned credentials from completed courses.
                  </p>
                  
               </div>
               <a
                  href="{{route('listcert')}}"
                  class="
                  
                  w-full
                  block
                  text-base
                  font-semibold
                  text-primary
                  bg-transparent
                  border border-[#D4DEFF]
                  rounded-md
                  text-center
                  p-4
                  hover:text-white hover:bg-primary hover:border-primary
                  transition
                  "
                  >
               Go to your credentials
               </a>
            </div>
               
            </div>
         </div>
      </div>
   </div>
</section>

    </div>
@endsection