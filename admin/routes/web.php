<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;





Route::get('/',[HomeController::class,'homeIndex']);
Route::get('/visitor',[VisitorController::class,'visitorIndex']);



Route::get('/service',[ServiceController::class,'serviceIndex']);
Route::get('/getServicesData',[ServiceController::class,'getServiceAll']);
Route::post('/serviceDelete',[ServiceController::class,'serviceDelete']);
Route::post('/serviceDetails',[ServiceController::class,'singleServiceGet']);
Route::post('/serviceEdit',[ServiceController::class,'singleServiceUpdate']);
Route::post('/serviceAdd',[ServiceController::class,'singleServiceAdd']);


Route::get('/course',[CourseController::class,'courseIndex']);
Route::get('/allCourse',[CourseController::class,'allCourse']);
Route::post('/courseDtails',[CourseController::class,'courseDetials']);
Route::post('/courseAdd',[CourseController::class,'courseAdd']);
Route::post('/courseUpdate',[CourseController::class,'courseUpdate']);
Route::post('/courseDelete',[CourseController::class,'courseDelete']);
// Route::post('/')


Route::get('/project',[ProjectController::class,'projectIndex']);
Route::get('/allProject',[ProjectController::class,'getAllProject']);
Route::post('/getSingleProject',[ProjectController::class,'getSingleProject']);
Route::post('/updateProject',[ProjectController::class,'updateProject']);
Route::post('/deleteProject',[ProjectController::class,'deleteProject']);
Route::post('/addProject',[ProjectController::class,'addProject']);







