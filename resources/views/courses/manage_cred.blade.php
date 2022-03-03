@extends('layouts.app')

@section('content')
<div class="md:grid md:grid-cols-4 md:gap-6">
    <div class="mt-5 md:mt-0 md:col-span-2 md:col-start-2">
        <form action="{{route('savecred', $id)}}" method="POST">
        @csrf
        @method('PUT')
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-2">
                  <label for="institute" class="block text-sm font-medium text-gray-700"> Issued by </label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    
                    <input type="text" name="institute" id="institute" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm 
                    border-gray-300 @error('institute') border-red-500 @enderror" @if ($credential != null) value="{{$credential->institute_name}}" @else value="" @endif
                    placeholder="Institute">
                  </div>
                  @error('institute')
                            <div class="text-red-500 mt-2 text-sm text-left">
                                {{ $message }}
                            </div>                        
                @enderror
                </div>
              </div>
  
              <div>
                <label for="certificate" class="block text-sm font-medium text-gray-700"> Course name on certificate</label>
                <div class="mt-1 mb-5">
                  <input type="text" id="certificate" name="certificate" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Name" 
                  @if ($credential != null) 
                  value="{{$credential->certificate_name}}"
                  @else
                  value=""
                  @endif
                  >
                </div>
                
              </div>

              <div>
                <label for="position" class="block text-sm font-medium text-gray-700"> Educator Information </label>
                <div class="mt-1 mb-5">
                  <input type="text" id="position" name="position" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Title/Position" 
                  @if ($credential != null)
                  value={{$credential->educator_title}}
                  @else 
                  value=""
                  @endif
                  >
                </div>
                
              </div>
  
              
            </div>

            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <a class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md" href="{{url()->previous()}}">Cancel</a>
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
            </div>
          </div>
        </form>
      
    </div>
</div>
@endsection