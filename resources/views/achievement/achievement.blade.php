@extends('layouts.student_app')

@section('content')
    <div>
        <!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Certificate Name</th>
              <th scope="col" class="px-6 py-3 text-right text-md font-medium text-gray-500 uppercase tracking-wider">Date issued</th>
              <th scope="col" class="px-6 py-3 text-right text-md font-medium text-gray-500 uppercase tracking-wider">Action</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($earned_certificates as $certificate)
                
            
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  
                  <div>
                    <div class="text-sm font-medium text-gray-900">Certificate of {{$certificate->cert_name}}</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                @php
                    $newdate = strtotime($certificate->created_at);
                    $date = date('M d, Y', $newdate);
                @endphp
                {{$date}}
                </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a href="{{route('downloadcert', [$certificate->cert_name])}}" class="text-indigo-600 hover:text-indigo-900">Download</a>
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
    
@endsection