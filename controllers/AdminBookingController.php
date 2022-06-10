<?php
namespace controllers;

use models\Booking;
use models\Movie;
use models\ShowTime;

class AdminBookingController
{
    public function index()
    {
        $movie_md = new Movie();
        $time_md = new ShowTime();
        $booking_md = new Booking();
        $bookings = $booking_md->orders(request('mid'),request('date'),request('time'));

        return view('admin/bookings',[
            'movies' => $movie_md->getAll(),
            'times' => $time_md->getAll(),
            'bookings' => $bookings,
        ]);
    }
}
