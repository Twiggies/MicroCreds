<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| Route for Auth
|--------------------------------------------------------------------------
| Routes for Authentication such as Register/Login 
|
*/
Route::get('/educatorregister', function() {
    return view('auth.educator_register');
})->name('educatorregister');

Route::post('/educatorregister', [RegisterController::class, 'store']);

/*
|--------------------------------------------------------------------------
| Route for Courses (Educator)
|--------------------------------------------------------------------------
| Routes for Educator navigating to courses related pages
|
*/

Route::get('/createdcourses', function () {
    return view('courses.created_courses');
});

