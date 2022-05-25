<?php
// implement your routes here
use app\Route;
use controllers\AuthController;
use controllers\HomeController;
use controllers\MovieController;
use controllers\BookingController;
use controllers\ScheduleController;

Route::get('/',[HomeController::class,'index']);
Route::get('/schedule',[ScheduleController::class,'index']);
Route::get('/movies',[MovieController::class,'index']);
Route::get('/bookings/step1',[BookingController::class,'booking']);
Route::get('/bookings/step2',[BookingController::class,'purchase']);
Route::get('/bookings/step3',[BookingController::class,'complete']);
Route::get('/login',[AuthController::class,'login']);
Route::get('/register',[AuthController::class,'register']);
