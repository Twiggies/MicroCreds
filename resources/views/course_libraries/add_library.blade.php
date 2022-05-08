@extends('layouts.app')

@section('content')
<div class="md:grid md:grid-cols-4 md:gap-6">
    <div class="mt-5 md:mt-0 md:col-span-2 md:col-start-2">
        <form action="{{route('createlibrary')}}" method="POST">
        @csrf
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-2">
                  <label for="libraryname" class="block text-sm font-medium text-gray-700"> Library Name </label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    
                    <input type="text" name="libraryname" id="libraryname" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm 
                    border-gray-300 @error('libraryname') border-red-500 @enderror" value="{{old('libraryname')}}"
                    placeholder="Name">
                  </div>
                  @error('libraryname')
                            <div class="text-red-500 mt-2 text-sm text-left">
                                {{ $message }}
                            </div>                        
                @enderror
                </div>
              </div>
  
              <div>
                <label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
                <div class="mt-1 mb-5">
                  <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Description" value=
                  {{old('description')}}></textarea>
                </div>
                
              </div>
  
              
            </div>
            
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <a class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md" href="{{route('courselibraries')}}">Cancel</a>
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
            </div>
          </div>
        </form>
      
    </div>
</div>
@endsection