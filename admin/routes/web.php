<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImageController;

//Admin login logout
Route::get('/login',[LoginController::class,'loginIndex']);
Route::post('/loginCheck',[LoginController::class,'onLogin']);
Route::post('/register',[LoginController::class,'onRegistration']);
Route::get('/logout',[LoginController::class,'onLogout']);



Route::get('/',[HomeController::class,'homeIndex'])->middleware('loginCheck');
Route::get('/visitor',[VisitorController::class,'visitorIndex'])->middleware('loginCheck');



Route::get('/service',[ServiceController::class,'serviceIndex'])->middleware('loginCheck');
Route::get('/getServicesData',[ServiceController::class,'getServiceAll'])->middleware('loginCheck');
Route::post('/serviceDelete',[ServiceController::class,'serviceDelete'])->middleware('loginCheck');
Route::post('/serviceDetails',[ServiceController::class,'singleServiceGet'])->middleware('loginCheck');
Route::post('/serviceEdit',[ServiceController::class,'singleServiceUpdate'])->middleware('loginCheck');
Route::post('/serviceAdd',[ServiceController::class,'singleServiceAdd'])->middleware('loginCheck');


Route::get('/course',[CourseController::class,'courseIndex'])->middleware('loginCheck');
Route::get('/allCourse',[CourseController::class,'allCourse'])->middleware('loginCheck');
Route::post('/courseDtails',[CourseController::class,'courseDetials'])->middleware('loginCheck');
Route::post('/courseAdd',[CourseController::class,'courseAdd'])->middleware('loginCheck');
Route::post('/courseUpdate',[CourseController::class,'courseUpdate'])->middleware('loginCheck');
Route::post('/courseDelete',[CourseController::class,'courseDelete'])->middleware('loginCheck');
// Route::post('/')


Route::get('/project',[ProjectController::class,'projectIndex'])->middleware('loginCheck');
Route::get('/allProject',[ProjectController::class,'getAllProject'])->middleware('loginCheck');
Route::post('/getSingleProject',[ProjectController::class,'getSingleProject'])->middleware('loginCheck');
Route::post('/updateProject',[ProjectController::class,'updateProject'])->middleware('loginCheck');
Route::post('/deleteProject',[ProjectController::class,'deleteProject'])->middleware('loginCheck');
Route::post('/addProject',[ProjectController::class,'addProject'])->middleware('loginCheck');


Route::get('/contact',[ContactController::class,'contactIndex'])->middleware('loginCheck');
Route::get('/getAllContact',[ContactController::class,'getAllContact'])->middleware('loginCheck');
Route::post('/contactDetails',[ContactController::class,'contactDetails'])->middleware('loginCheck');
Route::post('/deleteContact',[ContactController::class,'deleteContact'])->middleware('loginCheck');

Route::get('/review',[ReviewController::class,'reviewIndex'])->middleware('loginCheck');
Route::get("/getAllReview",[ReviewController::class,'getAllReview'])->middleware('loginCheck');
Route::post('/getReviewDetails',[ReviewController::class,'getReviewDetails'])->middleware('loginCheck');
Route::post('/reviewUpdate',[ReviewController::class,'reviewUpdate'])->middleware('loginCheck');
Route::post('/deleteReview',[ReviewController::class,'deleteReview'])->middleware('loginCheck');
Route::post('/addReview',[ReviewController::class,'addReview'])->middleware('loginCheck');

Route::get('/gallery',[GalleryController::class,'galleryIndex'])->middleware('loginCheck');
Route::post('/uploadImage',[GalleryController::class,'imageUpload'])->middleware('loginCheck');
Route::get('/imageJson',[GalleryController::class,'imageJson'])->middleware('loginCheck');
Route::post('/onScrollImage',[GalleryController::class,'onScrollImage'])->middleware('loginCheck');
Route::post('/deleteImage',[GalleryController::class,'deleteImage'])->middleware('loginCheck');