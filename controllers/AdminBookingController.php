<?php
namespace controllers;

use Carbon\Carbon;
use models\Booking;
use models\Movie;
use models\ShowTime;

class AdminBookingController
{
    public function index()
    {
        !is_admin() && redirectBack() ; 
        $movie_md = new Movie();
        $time_md = new ShowTime();
        $booking_md = new Booking();
        $date = request('date');
        $time = request('time');
        $mid = request('mid');
        if (!$date && !$time && !$mid){
            // default to all orders for today
            $today = new Carbon();
            $date = $today->format('Y-m-d');
            $bookings = $booking_md->orders($date);
        }else{
            $bookings = $booking_md->orders($date, $time, $mid);
        }

        return view('admin/bookings',[
            'movies' => $movie_md->getAll(),
            'times' => $time_md->getAll(),
            'bookings' => $bookings,
            'date' => $date,
        ]);
    }
}
