@extends('layouts.student_app')

@section('content')
<!-- component -->
<div class="w-full relative mt-4 shadow-2xl rounded my-24 overflow-visible">
    <div class="top h-64 w-full bg-blue-600 overflow-visible relative" >
      <img src="https://images.unsplash.com/photo-1503264116251-35a269479413?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" alt="" class="bg w-full h-full object-cover object-center absolute z-0">
      <div class="flex flex-col justify-center items-center relative h-full bg-black bg-opacity-50 text-white">
        @if ($profile->picture != null)
        <img id="profile-pic" src="{{asset('storage/images/profile/'.$profile->user_id.'/'.$profile->picture)}}" class="h-48 w-48 object-cover rounded-full">
        @else 
        <img id="profile-pic" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg" class="h-48 w-48 object-cover rounded-full">
        @endif
      </div>
    </div>
    
  
      <div class="col-span-12 md:border-solid md:border-l md:border-black md:border-opacity-25 h-full pb-12 md:col-span-10">
        <div class="px-4 pt-4">
          <div class="flex flex-col space-y-8">
            <div class="text-right ">
                <button onclick="location.href='{{route('editprofile')}}'" class="font-semibold mx-2 my-2 bg-white transition duration-150 ease-in-out hover:bg-gray-100 hover:text-white hover:bg-indigo-500 rounded border border-indigo-700 text-indigo-700 px-6 py-2 text-lg focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700">Edit Profile</button>
            </div>
            <div>
              <h3 class="text-2xl font-semibold">Basic Information</h3>
              
              <hr>
            </div>
  

  
            <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4">
  
              <div class="form-item w-full">
                <label class="text-xl ">Firstname</label>
                <input type="text" name="firstname"  id="firstname" disabled value="{{ucfirst(auth()->user()->firstname)}}" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " >
              </div>
              
              <div class="form-item w-full">
                <label class="text-xl ">Lastname</label>
                <input type="text" name="lastname" id="lastname" disabled value="{{ucfirst(auth()->user()->lastname)}}" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " >
              </div>
              
            </div>
            
            <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                <div class="form-item w-1/3">
                    <label class="text-xl">Email</label>
                    <input type="text" disabled value="{{auth()->user()->email}}" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " >
                </div>
            </div>

            <div>
              <h3 class="text-2xl font-semibold ">More About Me</h3>
              <hr>
            </div>
  
            <div class="form-item w-full">
              <label class="text-xl ">Biography</label>
              <textarea cols="30" rows="10" class="w-full appearance-none text-black rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 " disabled>{{$profile->about}}</textarea>
            </div>
  
            <div>
              <h3 class="text-2xl font-semibold">My Linkedin</h3>
              <hr>
            </div>
  
            <div class="form-item">
              <label class="text-xl ">LinkedIn</label>
              <input type="text" value="{{$profile->linkedin}}" class="w-full appearance-none text-black rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 " disabled>
            </div>
  
        </div>
        </div>
      </div>
  
  
    </div>
  </div>
@endsection