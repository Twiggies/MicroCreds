<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EducatorController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CourseLibraryController;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\EnrollmentController;

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

Route::get('/student_dashboard', [StudentController::class, 'index'])->name('student_dashboard')->middleware('auth');
/*
|--------------------------------------------------------------------------
| Route for Auth
|--------------------------------------------------------------------------
| Routes for Authentication such as Register/Login 
|
*/
Route::get('/educatorregister', [RegisterController::class, 'index'])->name('educatorregister');

Route::post('/educatorregister', [RegisterController::class, 'store'])->name('educator_register_request');

Route::get('/educatorlogin', function() {
    return view('auth.educator_login');
})->name('educatorlogin');

Route::get('/studentregister', [RegisterController::class, 'student_index'])->name('studentregister');

Route::post('/studentregister', [RegisterController::class, 'studentreg'])->name('student_register_request');

Route::get('/studentlogin', [LoginController::class,'student_index'])->name('studentlogin');

Route::post('/studentlogin', [LoginController::class,'student_login'])->name('student_login_request');

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

Route::get('/course/{id}', [CourseController::class, 'viewCourse'])->name('viewcourse')->middleware('course_access');

Route::get('/editcourse/{id}',[CourseController::class, 'editCourse'])->name('editcourse');

Route::put('/editcourse/{id}', [CourseController::class, 'updateCourse'])->name('updatecourse');

Route::get('/browsecourses', [CourseController::class, 'browse'])->name('browsecourses');

Route::get('/coursedetails/{course_id}', [CourseController::class, 'details'])->name('detailscourse');

Route::post('/coursedetails/{course_id}', [EnrollmentController::class, 'store'])->name('enroll');


/*
|--------------------------------------------------------------------------
| Route for Modules (Educator)
|--------------------------------------------------------------------------
| Routes for Educator navigating to modules related pages
|
*/



Route::middleware('course_access')->group(function () {
    Route::get('/course/{id}/addmodule', [ModuleController::class, 'create'])->name('addmodule');

    Route::post('/course/{id}/addmodule', [ModuleController::class, 'store'])->name('addnewmodule');

    Route::get('/course/{id}/viewmodule={moduleid}', [ModuleController::class, 'index'])->name('viewmodule');

    Route::get('/course/{id}/editmodule/{moduleid}', [ModuleController::class, 'edit'])->name('editmodule');

    Route::put('/course/{id}/editmodule/{moduleid}', [ModuleController::class, 'update'])->name('updatemodule');
});
/*
|--------------------------------------------------------------------------
| Route for Lesson (Educator)
|--------------------------------------------------------------------------
| Routes for Educator navigating to lessons related pages
|
*/
Route::middleware('course_access')->group(function () {
    Route::get('/course/{id}/viewmodule={moduleid}/addlesson', [LessonController::class, 'create'])->name('addlesson');

    Route::get('/course/{id}/viewmodule={moduleid}/lesson/{lessonid}-edit', [LessonController::class, 'edit'])->name('editlesson');

    Route::put('/course/{id}/viewmodule={moduleid}/lesson/{lessonid}-edit', [LessonController::class, 'store'])->name('updatelesson');

    Route::get('/course/{id}/viewmodule={moduleid}/lesson/{lessonid}', [LessonController::class, 'index'])->name('viewlesson');
});


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

Route::get('/addnewlibrary', [CourseLibraryController::class, 'create'])->name('addlibrary');

Route::post('/addnewlibrary', [CourseLibraryController::class, 'store'])->name('createlibrary');

Route::get('/viewlibrary/{library}', [CourseLibraryController::class, 'show'])->name('viewlibrary');


/*
|--------------------------------------------------------------------------
| Route for Materials (Educator)
|--------------------------------------------------------------------------
| Routes for Educator navigating to materials related pages
|
*/
Route::get('/materials', [MaterialController::class, 'index'])->name('materials');

Route::post('/materials', [MaterialController::class, 'store'])->name('addmaterial');

Route::get('/downloadfile/{file}', [MaterialController::class, 'download'])->name('downloadFile');

Route::get('/deletefile/{file}{id}', [MaterialController::class, 'delete'])->name('deleteFile');

Route::get('/lessonmaterials', [MaterialController::class, 'fetch'])->name('fetchmaterials');

Route::post('/{lessonid}/attachmaterials', [MaterialController::class, 'attach'])->name('attachmaterials');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('create-cert-file', [CredentialController::class, 'index']);

Route::get('/course/{id}/managecred', [CredentialController::class, 'create'])->name('managecred');

Route::put('/course/{id}/managecred', [CredentialController::class, 'store'])->name('savecred');

Route::get('/course/{id}/generated-pdf', [CredentialController::class, 'generate'])->name('generate');