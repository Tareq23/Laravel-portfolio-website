<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

Route::get('/',[HomeController::class,'homeIndex']);
Route::post('/addContact',[ContactController::class,'addContact']);