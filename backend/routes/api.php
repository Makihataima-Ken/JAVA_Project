<?php

use App\Http\Controllers\AdminController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

//Authentication process
Route::group(['prefix'=>'auth'],function(){
        Route::post('/register',[RegisterController::class,'register']);
        Route::post('/login',[LoginController::class,'login']);
        Route::get('/profile',[ProfileController::class,'profile']);
        Route::post('/logout',[LogoutController::class,'logout']);
});

//Order procedures
Route::group(['prefix'=>'orders'],function(){
        Route::post('/add_order',[OrderController::class,'add_order']);
        Route::delete('/cancel_order/{id}',[OrderController::class,'cancel_order']);
        Route::get('/user_orders',[OrderController::class,'user_orders']); // screen to show all user's orders
        Route::get('/order_details/{id}',[OrderController::class,'order_details']);// have a look on the order
});

//Admin procedures
Route::post('/approve_order/{id}',[AdminController::class,'approve_order']);
Route::post('/reject_order/{id}',[AdminController::class,'reject_order']);
Route::get('/pending_orders',[AdminController::class,'pending_orders']);