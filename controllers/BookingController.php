<?php

namespace controllers;

use Carbon\Carbon;
use models\Movie;
use Carbon\CarbonPeriod;
use models\Booking;

class BookingController
{
    public function booking()
    {
        
        $movie_name = request('movie');
        if (!$movie_name){
            setError([
                "message" => "Please select one movie .",
            ]);
            return redirectBack();
        }
        $movies = new Movie();
        $bookings = new Booking();
        $movie = $movies->where(request('movie'),'name')->getOne();
        $period = new CarbonPeriod($movie['start_date'],$movie['end_date']);
        $today_date =  Carbon::now();
        $today_date =  $today_date->toDateString();
        $show_times = $movies->times($movie['id']);
        $show_date =  $_SESSION['seat_data'][$movie_name]['date'] ?  $_SESSION['seat_data'][$movie_name]['date'] : $today_date;
        $selected_seats = $_SESSION['seat_data'][$movie_name]['seats'];
        $soldSeats = $bookings->soldSeats("".$movie['id'],$show_date,$show_times[0]['show_time']);
        return view('booking',[
            'selected_seat' => json_encode($selected_seats),
            'movie' => $movie,
            'show_times' => $show_times,
            'period' => $period,
            'soldSeats' => $soldSeats,
            'today_date' => $today_date,
            'show_date' => $show_date,
        ]);
    }

    public function purchase()
    {
        $mov = request('movie');
        if (!$mov){
            setError([
                "message" => "Please select one movie .",
            ]);
            return redirectBack();
        }
        $movies = new Movie();
        $movie = $movies->where($mov,'name')->getOne();
        if (!$movie){
            var_dump('not found');
            return;
        }
        $seat_data = $_SESSION['seat_data'][$mov];
        $seats = $seat_data['seats'];
        $date = new Carbon($seat_data['date']);
        $time = new Carbon($seat_data['time']);
        if($seat_data == null | $seats == null | $date == null | $time == null ){
            setError([
                "message" => "Missing Some data .",
            ]);
            return redirectBack();
        }
        
        $new_seats = [];
        foreach ($seats as $st) {
            if($st !== ""){
                $new_seats[$st[0]][] = $st;
            }
        }
        
        return view('purchase', [
            "movie" => $movie,
            "seats" => $new_seats,
            "date" => $date->format('d-m-Y'),
            "time" => $time->format('g:i a')
        ]);
    }

    public function storePurchase()
    {
        $movie_name = request('movie_name');
        if(!$movie_name){
            setError([
                "message" => "Please select one movie .",
            ]);
            return redirectBack();
        }

        $movies = new Movie();
        $movie = $movies->where($movie_name,'name')->getOne();
        if (!$movie){
            setError([
                "message" => "Movie Not Found .",
            ]);
            return redirectBack();
        }

        $seat_data = $_SESSION['seat_data'][$movie_name];

        $bookings = new Booking();
        $booking = $bookings->store([
            'user_id'=>'1',
            'movie_id'=> "".$movie['id'],
            'date'=>$seat_data['date'],
            'show_time'=>$seat_data['time'],
            'seats'=> implode(',',$seat_data['seats']),
        ]);
        if($booking){
            unset($_SESSION['seat_data'][$movie_name]);
            return redirect('/bookings/step3');
        }

    }

    public function complete()
    {
        return view('purchaseComplete');
    }

    public function seatHandler()
    {
        if(request('seats')){
            $_SESSION['seat_data'][request('movie')]['seats'] = explode(',',request('seats'));
            $_SESSION['seat_data'][request('movie')]['date'] = request('date');
            $_SESSION['seat_data'][request('movie')]['time'] = request('time');
        }else{
            unset($_SESSION['seat_data'][request('movie')]);
        }
        echo request('seats');
    }

    public function getSeats()
    {
        $movie_id = request('movie_id');
        $movie_name = request('movie_name');
        $movie_date = request('movie_date');
        $movie_time = request('movie_time');
        $bookings = new Booking();
        $selected_seats = $_SESSION['seat_data'][$movie_name]['seats'];
        $soldSeats = $bookings->soldSeats($movie_id,$movie_date,$movie_time);
        echo json_encode($soldSeats);
    }
}
