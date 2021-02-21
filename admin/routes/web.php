<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;





Route::get('/',[HomeController::class,'homeIndex']);
Route::get('/visitor',[VisitorController::class,'visitorIndex']);



Route::get('/service',[ServiceController::class,'serviceIndex']);
Route::get('/getServicesData',[ServiceController::class,'getServiceAll']);
Route::post('/serviceDelete',[ServiceController::class,'serviceDelete']);
Route::post('/serviceDetails',[ServiceController::class,'singleServiceGet']);
Route::post('/serviceEdit',[ServiceController::class,'singleServiceUpdate']);
Route::post('/serviceAdd',[ServiceController::class,'singleServiceAdd']);










