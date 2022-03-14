<?php

use App\Http\Controllers\AdminController;
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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressController;

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

Route::get('/add-new-admin', function() {
    return view('admin.addnewadmin');
});

Route::get('/student_dashboard', [StudentController::class, 'index'])->name('student_dashboard')->middleware('auth');

Route::get('/profile', [ProfileController::class, 'index'])->name('myprofile')->middleware('auth');

Route::get('/editprofile', [ProfileController::class, 'edit'])->name('editprofile')->middleware('auth');

Route::put('/editprofile', [ProfileController::class, 'update'])->name('saveprofile')->middleware('auth');
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

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
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

Route::get('/enrolled-courses', [CourseController::class, 'enrolled'])->name('enrolledcourses');
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

    Route::get('/course/{id}/viewmodule={moduleid}/lesson/{lessonid}/complete', [ProgressController::class, 'store'])->name('completelesson');
    
    Route::get('/course/{id}/viewmodule={moduleid}/lesson/{lessonid}/completequiz', [ProgressController::class, 'complete'])->name('completequiz');
});


/*
|--------------------------------------------------------------------------
| Route for Quiz (Educator)
|--------------------------------------------------------------------------
| Routes for Educator navigating to quiz related pages
|
*/
Route::get('/course/{id}/viewmodule={moduleid}/lesson/{lessonid}/managequiz', [QuizController::class, 'create'])->name('managequiz');

Route::get('quiz-{lessonid}', [QuizController::class, 'index'])->name('getquiz');

Route::put('/course/{id}/viewmodule={moduleid}/lesson/{lessonid}/managequiz', [QuizController::class, 'store'])->name('updatequiz');

Route::get('/course/{id}/viewmodule={moduleid}/lesson/{lessonid}/quiz', [QuizController::class, 'show'])->name('showquiz');



Route::post('/checkanswer', [QuizController::class, 'check'])->name('checkanswer');

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

Route::get('/course/{id}/viewmodule={moduleid}/lesson/{lessonid}-edit/{material_id}-deattach', [MaterialController::class, 'deattach'])->name('deattach');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*
|--------------------------------------------------------------------------
| Route for Certificates (Educator)
|--------------------------------------------------------------------------
| Routes for Educator navigating to materials related pages
|
*/

Route::get('create-cert-file', [CredentialController::class, 'index']);

Route::get('/course/{id}/managecred', [CredentialController::class, 'create'])->name('managecred');

Route::put('/course/{id}/managecred', [CredentialController::class, 'store'])->name('savecred');

Route::get('/course/{id}/generated-pdf', [CredentialController::class, 'generate'])->name('generate');

Route::get('/earned-certificates', [CredentialController::class, 'list'])->name('listcert');

Route::get('/download-certificate/{cert_name}', [CredentialController::class, 'download'])->name('downloadcert');

/*
======================
Admin Modules
======================
*/
Route::get('/admin-login', [AdminController::class, 'index'])->name('adminlogin');

Route::post('/admin-login', [AdminController::class, 'login'])->name('loginadmin');

Route::get('/admin-logout', [AdminController::class, 'logout'])->name('logoutadmin');

Route::get('/admin-list', [AdminController::class, 'admins'])->name('adminlist');

Route::post('/add-admin', [AdminController::class, 'store'])->name('createadmin');

Route::post('/ajax-add-admin', [AdminController::class, 'ajaxStore'])->name('ajax-add-admin');

Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');

Route::get('/pending-courses', [AdminController::class, 'pending'])->name('pendingcourses');

Route::get('/course-details/{course_id}', [AdminController::class, 'coursedetails'])->name('admin_coursedetails');

Route::get('/educator-list', [AdminController::class, 'educators'])->name('educatorlist');

Route::get('/edit-educator/{user_id}', [AdminController::class, 'editeducator'])->name('editeducator');

Route::get('/student-list', [AdminController::class, 'students'])->name('studentlist');