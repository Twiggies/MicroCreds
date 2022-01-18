<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EducatorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ModuleController;

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

Route::get('/dashboard', [EducatorController::class, 'index'])
->name('dashboard')
->middleware('auth');
/*
|--------------------------------------------------------------------------
| Route for Auth
|--------------------------------------------------------------------------
| Routes for Authentication such as Register/Login 
|
*/
Route::get('/educatorregister', [RegisterController::class, 'index'])->name('educatorregister');

Route::post('/educatorregister', [RegisterController::class, 'store']);

Route::get('/educatorlogin', function() {
    return view('auth.educator_login');
})->name('educatorlogin');

Route::post('/educatorlogin', [LoginController::class, 'store']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
/*
|--------------------------------------------------------------------------
| Route for Courses (Educator)
|--------------------------------------------------------------------------
| Routes for Educator navigating to courses related pages
|
*/

Route::get('/createdcourses', [CourseController::class, 'viewCourses'])->name('createdcourses');

Route::get('/addnewcourse', [CourseController::class, 'addCourse'])->name('addcourse');

Route::post('/addnewcourse', [CourseController::class, 'addNewCourse'])->name('addnewcoursereq');

Route::get('/course/{id}', [CourseController::class, 'viewCourse'])->name('viewcourse');

/*
|--------------------------------------------------------------------------
| Route for Modules (Educator)
|--------------------------------------------------------------------------
| Routes for Educator navigating to modules related pages
|
*/
Route::get('/course/{id}/addmodule', [ModuleController::class, 'create'])->name('addmodule');

Route::post('/course/{id}/addmodule', [ModuleController::class, 'store'])->name('addnewmodule');

Route::get('/course/{id}/viewmodule={moduleid}', [ModuleController::class, 'index'])->name('viewmodule');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
