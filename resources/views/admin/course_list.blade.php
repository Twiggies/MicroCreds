@extends('admin.layout')

@section('content')
    <!-- component -->
<div class="text-gray-900 bg-white p-4 mb-10">
    <div class="pt-2 relative mx-auto text-gray-600">
        <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
          type="search" name="search" placeholder="Search">
    
        
        <button type="submit" class="mt-4 ml-4 bg-blue-500 text-white px-4 py-2 rounded-md text-1xl font-medium hover:bg-blue-700">
          Search
        </button>
        
    </div>
</div>

@if (session('message'))
<div class="{{session('message-type')}} p-3 rounded-lg mb-3">
    {{session('message')}}
</div>
@endif

<div class="text-gray-900 bg-gray-200">
    <div class="p-4 flex">
        <h1 class="text-3xl">
            Courses
        </h1>
        
    </div>
    <div class="px-3 py-4 flex justify-center">
        <table class="w-full text-md bg-white shadow-md rounded mb-4">
            <tbody>
                <tr class="border">
                    <th class="border w-2 text-left p-3 px-5">ID</th>
                    <th class="border text-left p-3 px-5">Course name</th>
                    <th class="border text-left p-3 px-5">Educator</th>
                    <th class="border text-left p-3 px-5">Status</th>
                    <th class="border text-left p-3 px-5">Created at</th>
                    <th class="border w-3 text-left p-3 px-5">Action</th>
                </tr>
                @foreach ($courses as $course)
                    
               
                <tr class="border border-collapse hover:bg-yellow-100 bg-gray-100">
                    <td class="border p-3 px-5">{{$course->id}}</td>
                    <td class="border p-3 px-5">{{$course->name}}</td>
                    @php
                        $educator = App\Models\User::find($course->user_id);
                    @endphp
                    <td class="border p-3 px-5">{{$educator->email}}</td>
                    <td class="border p-3 px-5">{{$course->status}}</td>
                    @php
                        $newdate = strtotime($course->created_at);
                        $date = date('M d, Y', $newdate);
                    @endphp
                    <td class="border p-3 px-5">{{$date}}</td>
                    <td class="border p-3 px-5"> <button onclick="location.href='{{route('admin_coursedetails', ['course_id' => $course->id])}}'" class="bg-blue-500 text-white px-3 py-2 rounded-md text-md font-medium hover:bg-blue-700 transition duration-300">View</button></td>
                    
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>





@endsection

