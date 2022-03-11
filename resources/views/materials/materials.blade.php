@extends('layouts.app')

@section('content')
    <div>
        <form class="mb-5" id="file-form" method="post" enctype="multipart/form-data">
            @csrf
            <label class="ml-6 mx-2 my-2 font-semibold bg-white transition duration-150 ease-in-out hover:border-gray-900 hover:text-gray-900 rounded border border-gray-800 text-gray-800 px-8 py-3 text-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-800" for="material">Add Materials</label>
            
            <input id="material" name="material" type="file" class="hidden"/></form>
        
        <!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">File</th>
              <th scope="col" class="px-6 py-3 text-right text-md font-medium text-gray-500 uppercase tracking-wider">Action</th>
              
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($materials as $material)
                
            
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{$material->file}}</div>
                  </div>
                </div>
              </td>
              
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a href="{{route('downloadFile', [$material->file])}}" class="text-indigo-600 hover:text-indigo-900">Download</a>
                <a href="{{route('deleteFile', [$material->file, $material->id])}}" class="text-red-500 hover:text-red-900">Delete</a>
              </td>
              
            </tr>
            @endforeach

            <!-- More people... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#material').on('change',function() {
                var fileData = document.getElementById('file-form');
                var formData = new FormData(fileData);
                $.ajax({
                    type:'POST',
                    data: formData,
                    
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: '{{route('addmaterial')}}',
                    success: function(response) {
                        location.reload();
                        alert(response);
                    },
                    error: function(error) {
                        console.log(JSON.stringify(error));
                    }
                })
            });
        })
    </script>
@endsection