<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/', function () {
    
    Route::get('/user',[UserController::class,'index']);

});