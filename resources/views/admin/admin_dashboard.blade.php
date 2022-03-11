@extends('admin.layout')

@section('content')
<h1 class="text-3xl text-black pb-6">Dashboard</h1>
    
                <div class="flex flex-wrap mt-6">
                    <div class="w-full lg:w-1/2 pr-0 lg:pr-2">
                        
                        <div class="w-full grid grid-cols-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                            <a aria-label="card 1" href="#" class="col-span-3 bg-white dark:bg-gray-800 rounded  focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 focus:outline-none focus:bg-gray-100 hover:bg-gray-100">
                                <div class="shadow px-8 py-6 flex items-center">
                                    
                                    
                                        <div class="ml-6">
                                            @php
                                                $courses = App\Models\Course::where('status', 'inactive')->orderBy('created_at', 'desc')->get();
                                            @endphp
                                            <h3 class="mb-1 leading-5 text-gray-800 dark:text-gray-100 font-bold text-2xl">{{$courses->count()}}
                                            </h3>
                                            <p
                                                class="text-gray-600 dark:text-gray-400 tracking-normal font-normal leading-5 text-xl">
                                                Pending Courses</p>
                                        </div>
                                  
                                </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
    
                <div class="w-full mt-12">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Latest Courses
                    </p>
                    <div class="bg-white overflow-auto">
                        <!-- component -->
                        <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                            <thead>
                              <tr>
                                <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-grey-dark border-b border-gray-400">City</th>
                                <th class="text-right py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-grey-dark border-b border-gray-400">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    
                               
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-gray-400">{{$course->name}}</td>
                                <td class="text-right py-4 px-6 border-b border-gray-400">
                                <button class="bg-blue-500 text-white px-3 py-2 rounded-md text-md font-medium hover:bg-blue-700 transition duration-300">View</button>
                                </td>
                              </tr>
                               @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
@endsection