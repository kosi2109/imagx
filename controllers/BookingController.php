<?php

namespace controllers;

use Carbon\Carbon;
use models\Movie;
use Carbon\CarbonPeriod;
use models\Booking;
use models\User;

class BookingController
{
    public function booking()
    {
        
        $movie_slug = request('movie');
        if (!$movie_slug){
            setError([
                "message" => "Please select one movie .",
            ]);
            return redirectBack();
        }
        $movies = new Movie();
        $bookings = new Booking();
        $movie = $movies->where($movie_slug,'slug')->getOne();
        $period = new CarbonPeriod($movie['start_date'],$movie['end_date']);
        $today_date =  Carbon::now();
        $today_date =  $today_date->toDateString();
        $show_times =  $movies->times($movie['id']);
        $generes = $movies->generes($movie['id']);
        $show_date =  $_SESSION['seat_data'][$movie_slug]['date'] ?  $_SESSION['seat_data'][$movie_slug]['date'] : $today_date;
        $selected_seats = $_SESSION['seat_data'][$movie_slug]['seats'];
        $soldSeats = $bookings->soldSeats("".$movie['id'],$show_date,$show_times[0]['show_time']);
        
        return view('booking',[
            'selected_seat' => json_encode($selected_seats),
            'movie' => $movie,
            'show_times' => $show_times,
            'period' => $period,
            'soldSeats' => $soldSeats,
            'today_date' => $today_date,
            'show_date' => $show_date,
            'generes' => $generes
        ]);
    }

    public function purchase()
    {
        login_required();

        $movie_slug = request('movie');
        if (!$movie_slug){
            setError([
                "message" => "Please select one movie .",
            ]);
            return redirectBack();
        }
        $movies = new Movie();
        $movie = $movies->where($movie_slug,'slug')->getOne();
        if (!$movie){
            var_dump('not found');
            return;
        }
        $seat_data = $_SESSION['seat_data'][$movie_slug];
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
        login_required();

        $movie_slug = request('movie_slug');
        if(!$movie_slug){
            setError([
                "message" => "Please select one movie .",
            ]);
            return redirectBack();
        }

        $movies = new Movie();
        $movie = $movies->where($movie_slug,'slug')->getOne();
        if (!$movie){
            setError([
                "message" => "Movie Not Found .",
            ]);
            return redirectBack();
        }

        $seat_data = $_SESSION['seat_data'][$movie_slug];
        $users = new User();
        $user = $users->where(auth()['username'],'username')->getOne();

        $bookings = new Booking();
        $booking = $bookings->store([
            'user_id'=>$user['id'],
            'movie_id'=> "".$movie['id'],
            'date'=>$seat_data['date'],
            'show_time'=>$seat_data['time'],
            'seats'=> implode(',',$seat_data['seats']),
        ]);
        if($booking){
            unset($_SESSION['seat_data'][$movie_slug]);
            return redirect('/bookings/step3');
        }else{
            setError([
                "message" => "Sorry , Can't purchase . Try Again . ",
            ]);
            return redirectBack();
        }

    }

    public function complete()
    {
        login_required();
        return view('purchaseComplete');
    }

    public function seatHandler()
    {
        login_required();
        
        if(request('seats')){
            $_SESSION['seat_data'][request('movie_slug')]['seats'] = explode(',',request('seats'));
            $_SESSION['seat_data'][request('movie_slug')]['date'] = request('date');
            $_SESSION['seat_data'][request('movie_slug')]['time'] = request('time');
        }else{
            unset($_SESSION['seat_data'][request('movie_slug')]);
        }
        echo request('seats');
    }

    public function getSeats()
    {
        login_required();

        $movie_id = request('movie_id');
        $movie_date = request('movie_date');
        $movie_time = request('movie_time');
        $bookings = new Booking();
        $soldSeats = $bookings->soldSeats($movie_id,$movie_date,$movie_time);
        echo json_encode($soldSeats);
    }
}
