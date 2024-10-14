<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

//Authentication process
Route::group(['prefix'=>'auth'],function(){
        Route::post('/register',[AuthController::class,'register']);
        Route::post('/login',[AuthController::class,'login']);
        Route::get('/profile',[AuthController::class,'profile']);
        Route::post('/logout',[AuthController::class,'logout']);
});

//Order procedures
Route::post('/add_order',[OrderController::class,'add_order']);
Route::delete('/cancel_order/{id}',[OrderController::class,'cancel_order']);

//Admin procedures
Route::post('/approve_order/{id}',[AdminController::class,'approve_order']);
Route::post('/reject_order/{id}',[AdminController::class,'reject_order']);