<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\CourseResource;
use App\Models\Course;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
    //Route::resource('courses', CourseController::class);
    Route::get('/courses', [CourseController::class, 'index']);
});

//Route::get('/courses', [CourseController::class, 'index']);

