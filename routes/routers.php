<?php
// implement your routes here
use app\Route;
use controllers\AdminBookingController;
use controllers\AdminMovieController;
use controllers\AuthController;
use controllers\HomeController;
use controllers\MovieController;
use controllers\BookingController;
use controllers\ProfileController;
use controllers\ScheduleController;
use controllers\TimeGenreController;

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

// profile
// dd(Route::get('/profile',[ProfileController::class,'index'])->auth());
Route::get('/profile',[ProfileController::class,'index']);

// auth
Route::get('/login',[AuthController::class,'login']);
Route::post('/login',[AuthController::class,'loginStore']);
Route::get('/register',[AuthController::class,'register']);
Route::post('/register',[AuthController::class,'registerStore']);
Route::post('/logout',[AuthController::class,'logout']);


// admin
// movie
Route::get('/admin/view-movies',[AdminMovieController::class,'index']);
Route::get('/admin/edit-movie',[AdminMovieController::class,'edit']);
Route::post('/admin/edit-movie',[AdminMovieController::class,'update']);
Route::get('/admin/create-movie',[AdminMovieController::class,'create']);
Route::post('/admin/create-movie',[AdminMovieController::class,'store']);
Route::post('/admin/delete-movie',[AdminMovieController::class,'destroy']);

// time and genre
Route::get('/admin/show-time-and-genre',[TimeGenreController::class,'index']);
Route::post('/admin/delete-time-genre',[TimeGenreController::class,'destroy']);
Route::post('/admin/update-time-genre',[TimeGenreController::class,'update']);
Route::post('/admin/create-time-genre',[TimeGenreController::class,'store']);

// admin booking
Route::get('/admin/view-bookings',[AdminBookingController::class,'index']);
