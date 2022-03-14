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
        <button onclick="popuphandler(true)" class="absolute right-0 mt-4 bg-blue-500 text-white px-4 py-2 rounded-md text-1xl font-medium hover:bg-blue-700">
            Add New Admin
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
            Admins
        </h1>
        
    </div>
    <div class="px-3 py-4 flex justify-center">
        <table class="w-full text-md bg-white shadow-md rounded mb-4">
            <tbody>
                <tr class="border">
                    <th class="border w-2 text-left p-3 px-5">ID</th>
                    <th class="border text-left p-3 px-5">Username</th>
                    <th class="border text-left p-3 px-5">Firstname</th>
                    <th class="border text-left p-3 px-5">Lastname</th>
                    <th class="border text-left p-3 px-5">Created at</th>
                </tr>
                @foreach ($admins as $admin)
                    
               
                <tr class="border border-collapse hover:bg-yellow-100 bg-gray-100">
                    <td class="border p-3 px-5">{{$admin->id}}</td>
                    <td class="border p-3 px-5">{{$admin->username}}</td>
                    <td class="border p-3 px-5">{{$admin->firstname}}</td>
                    <td class="border p-3 px-5">{{$admin->lastname}}</td>
                    @php
                        $newdate = strtotime($admin->created_at);
                        $date = date('M d, Y', $newdate);
                    @endphp
                    <td class="border p-3 px-5">{{$date}}</td>
                    
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>



<div id="popup" class="z-50 hidden fixed w-full flex justify-center inset-0">
    <div onclick="popuphandler(false)" class="w-full h-full bg-gray-900 z-0 absolute inset-0"></div>
    <div class="mx-auto container">
        <div class="flex items-center justify-center h-full w-full">
            <div class="bg-white rounded-md shadow fixed overflow-y-auto sm:h-auto w-10/12 md:w-8/12 lg:w-1/2 2xl:w-2/5">
                <div class="bg-gray-100 rounded-tl-md rounded-tr-md px-4 md:px-8 md:py-4 py-7 flex items-center justify-between">
                    <p class="text-base font-semibold">Add new admin</p>
                    <button role="button" aria-label="close label" onclick="popuphandler(false)" class="focus:ring-2 focus:ring-offset-2 focus:ring-gray-600 focus:outline-none">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/add_user-svg1.svg" alt="icon"/>
                       
                    </button>
                </div>
                <div class="px-4 md:px-10 pt-6 md:pt-12 md:pb-4 pb-7">
                    
                    <form class="mt-11" method="POST">
                        @csrf
                        <div class="flex items-center space-x-9">
                            <span>username</span>
                            <input name="username" placeholder="user name" class="focus:ring-2 focus:ring-gray-400 w-1/2 focus:outline-none placeholder-gray-500 py-3 px-3 text-sm leading-none text-gray-800 bg-white border rounded border-gray-200" />
                            
                        </div>
                        <div class="flex items-center space-x-9 mt-8">
                            <span>first name</span>
                            <input name="firstname" placeholder="first name" type="text" class="focus:ring-2 focus:ring-gray-400 w-1/2 focus:outline-none placeholder-gray-500 py-3 px-3 text-sm leading-none text-gray-800 bg-white border rounded border-gray-200" />
                            
                        </div>
                        <div class="flex items-center space-x-9 mt-8">
                            <span>last name</span>
                            <input name="lastname" placeholder="last name" type="text" class="focus:ring-2 focus:ring-gray-400 w-1/2 focus:outline-none placeholder-gray-500 py-3 px-3 text-sm leading-none text-gray-800 bg-white border rounded border-gray-200" />
                        </div>
                        <div class="flex items-center space-x-9 mt-8">
                            <span>password</span>
                            <input name="password" placeholder="password" type="text" class="focus:ring-2 focus:ring-gray-400 w-1/2 focus:outline-none placeholder-gray-500 py-3 px-3 text-sm leading-none text-gray-800 bg-white border rounded border-gray-200" />
                        </div>
                    </form>
                <div class="flex items-center justify-between mt-9">
                        <button role="button" aria-label="close button" onclick="popuphandler(false)" class="focus:ring-2 focus:ring-offset-2 focus:bg-gray-600 focus:ring-gray-600 focus:outline-none px-6 py-3 bg-gray-600 hover:bg-gray-500 shadow rounded text-sm text-white">Cancel</button>
                        <button aria-label="add user" role="button" id="add_admin" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-800 focus:outline-none px-6 py-3 bg-indigo-700 hover:bg-opacity-80 shadow rounded text-sm text-white">Add User</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
 <script>
     function popuphandler(flag) {
    if (flag) {
        document.getElementById("popup").classList.remove("hidden");
    } else {
        document.getElementById("popup").classList.add("hidden");
    }
}
 </script>
 <script>
     $('#add_admin').click(function (event) {
         event.preventDefault();
        let username = $("input[name='username']").val();
        let firstname = $("input[name='firstname']").val();
        let lastname = $("input[name='lastname']").val();
        let password = $("input[name='password']").val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
        $.ajax({
            type: "POST",
            data: {
                username,
                firstname,
                lastname,
                password,
            },
            url: "{{route('ajax-add-admin')}}",
            success: function(response) {
                location.reload();
               
            },
            error: function(error) {
                location.reload();
            }
        });

    })
     

        
     
 </script>
@endsection