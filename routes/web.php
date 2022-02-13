<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\EducatorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CourseLibraryController;
use App\Http\Controllers\QuizController;

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

Route::get('/editcourse/{id}',[CourseController::class, 'editCourse'])->name('editcourse');

Route::put('/editcourse/{id}', [CourseController::class, 'updateCourse'])->name('updatecourse');

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

Route::get('/editmodule/{moduleid}', [ModuleController::class, 'edit'])->name('editmodule');

Route::put('/editmodule/{moduleid}', [ModuleController::class, 'update'])->name('updatemodule');

/*
|--------------------------------------------------------------------------
| Route for Lesson (Educator)
|--------------------------------------------------------------------------
| Routes for Educator navigating to lessons related pages
|
*/
Route::get('/course/{id}/viewmodule={moduleid}/addlesson', [LessonController::class, 'create'])->name('addlesson');

Route::get('/editlesson/{lessonid}', [LessonController::class, 'edit'])->name('editlesson');

Route::put('/editlesson/{lessonid}', [LessonController::class, 'store'])->name('updatelesson');

Route::get('/course/{id}/viewmodule={moduleid}/lesson/{lessonid}', [LessonController::class, 'index'])->name('viewlesson');

/*
|--------------------------------------------------------------------------
| Route for Quiz (Educator)
|--------------------------------------------------------------------------
| Routes for Educator navigating to quiz related pages
|
*/
Route::get('/lesson/{lessonid}/managequiz', [QuizController::class, 'create'])->name('managequiz');

Route::get('fetchquiz-{lessonid}', [QuizController::class, 'index'])->name('getquiz');

Route::put('/lesson/{lessonid}/managequiz', [QuizController::class, 'store'])->name('updatequiz');

Auth::routes();

/*
|--------------------------------------------------------------------------
| Route for CourseLibrary (Educator)
|--------------------------------------------------------------------------
| Routes for Educator navigating to course library related pages
|
*/
Route::get('/courselibraries', [CourseLibraryController::class, 'index'])->name('courselibraries');


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
