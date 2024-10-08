<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'api','prefix'=>'auth'],function(){
        Route::post('/register',[AuthController::class,'register']);
        Route::post('/login',[AuthController::class,'login']);
        Route::get('/profile',[AuthController::class,'profile']);
        Route::post('/logout',[AuthController::class,'logout']);
});

Route::post('/add_order',[OrderController::class,'add_order']);
Route::get('/cancel_order/{id}',[OrderController::class,'cancel_order']);