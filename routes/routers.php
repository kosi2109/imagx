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

// booking process
Route::get('/bookings/step1',[BookingController::class,'booking']);
Route::get('/bookings/step2',[BookingController::class,'purchase']);
Route::post('/bookings/step2',[BookingController::class,'storePurchase']);
Route::get('/bookings/step3',[BookingController::class,'complete']);
Route::post('/bookings/seathandler',[BookingController::class,'seatHandler']);
Route::get('/get-seats',[BookingController::class,'getSeats']);

// auth
Route::get('/login',[AuthController::class,'login']);
Route::post('/login',[AuthController::class,'loginStore']);
Route::get('/register',[AuthController::class,'register']);
Route::post('/register',[AuthController::class,'registerStore']);
Route::post('/logout',[AuthController::class,'logout']);
