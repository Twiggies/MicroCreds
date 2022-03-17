@extends('layouts.app')

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
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="border-red-500 border-solid">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div>
          @endif
          <form action="{{route('saveprofile')}}" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-8">
            @csrf
            @method('PUT')
            <span>
            <label for="picture" class="text-md font-semibold">Choose a profile picture(2MB max):</label>
            <input type="file" id="picture" name="picture">
            @error('picture')
            <div class="text-red-500 mt-2 text-sm text-left">
              {{ $message }}
            </div>      
            @enderror
            </span>
            <div>
              <h3 class="text-2xl font-semibold">Basic Information</h3>
              
              <hr>
            </div>
  

  
            <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4">
  
              <div class="form-item w-full">
                <label class="text-xl ">Firstname</label>
                <input type="text" name="firstname"  id="firstname" value="{{ucfirst(auth()->user()->firstname)}}" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " >
              </div>
  
              <div class="form-item w-full">
                <label class="text-xl ">Lastname</label>
                <input type="text" name="lastname" id="lastname" value="{{ucfirst(auth()->user()->lastname)}}" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " >
              </div>
            </div>
            
            <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                <div class="form-item w-1/3">
                    <label class="text-xl">Email</label>
                    <input type="text" disabled value="{{auth()->user()->email}}" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " >
                </div>
            </div>

            @if (session()->get('isEducator') == true)
            <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                <div class="form-item w-1/3">
                    <label class="text-xl">Institute</label>
                    <input type="text" name="institute" id="institute" value="{{$profile->institute}}" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " >
                </div>
            </div>    
            @endif
            
            <div>
              <h3 class="text-2xl font-semibold ">More About Me</h3>
              <hr>
            </div>
  
            <div class="form-item w-full">
              <label class="text-xl ">Biography</label>
              <textarea cols="30" name="about" id="about" rows="10" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " >
                {{$profile->about}}
              </textarea>
            </div>
  
            <div>
              <h3 class="text-2xl font-semibold">My Social Media</h3>
              <hr>
            </div>
  
            <div class="form-item">
              <label class="text-xl ">LinkedIn</label>
              <input type="text" name="linkedin" id="linkedin" value="{{$profile->linkedin}}" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " >
            </div>
            
            <div class="text-right">
                <a class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md" href="{{url()->previous()}}">Cancel</a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
            </div>
          </form>
        </div>
      </div>
  
  
    </div>
  </div>
@endsection

