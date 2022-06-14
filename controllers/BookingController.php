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
            setError("Please select one movie");
            return redirectBack();
        }
        $movies = new Movie();
        $movie = $movies->where($movie_slug,'slug')->getOne();
        $today_date =  Carbon::now();
        if($movie['can_book_at'] > $today_date->format('Y-m-d') ){
            // check for is reach can book date
            return redirectBack();
        } 
        $bookings = new Booking();
        $period = new CarbonPeriod($movie['start_date'],$movie['end_date']);
        $today_date =  $today_date->toDateString();
        $show_times =  $movies->times($movie['id']);
        $genres = $movies->genres($movie['id']);
        $seat_data = getSeatData($movie_slug);
        $show_date = $seat_data['date'] ?  $seat_data['date'] : $today_date;
        $selected_seats = $seat_data['seats'];
        $soldSeats = $bookings->soldSeats("".$movie['id'],$show_date,$show_times[0]['show_time']);
        
        return view('booking',[
            'selected_seat' => json_encode($selected_seats),
            'movie' => $movie,
            'show_times' => $show_times,
            'period' => $period,
            'soldSeats' => $soldSeats,
            'today_date' => $today_date,
            'show_date' => $show_date,
            'genres' => $genres
        ]);
    }

    public function purchase()
    {
        login_required();

        $movie_slug = request('movie');
        if (!$movie_slug){
            
            setError("Please select one movie");
            return redirectBack();
        }
        $movies = new Movie();
        $movie = $movies->where($movie_slug,'slug')->getOne();
        if (!$movie){
            var_dump('not found');
            return;
        }
        $seat_data = getSeatData($movie_slug);
        $seats = $seat_data['seats'];
        $date = new Carbon($seat_data['date']);
        $time = new Carbon($seat_data['time']);
        if($seat_data == null | $seats == null | $date == null | $time == null ){
            setError("Missing Some data");
            return redirectBack();
        }
        
        $seats = seatsByRole($seats);
        
        return view('purchase', [
            "movie" => $movie,
            "seats" => $seats,
            "date" => $date->format('d-m-Y'),
            "time" => $time->format('g:i a')
        ]);
    }

    public function storePurchase()
    {
        login_required();

        $movie_slug = request('movie_slug');
        if(!$movie_slug){
            setError("Please select one movie .");
            return redirectBack();
        }

        $movies = new Movie();
        $movie = $movies->where($movie_slug,'slug')->getOne();
        if (!$movie){
            setError("Movie Not Found");
            return redirectBack();
        }

        $seat_data = getSeatData($movie_slug);
        $users = new User();
        $user = $users->where(auth()['username'],'username')->getOne();

        $bookings = new Booking();

        // backend check for sold seats
        $all_bookings = $bookings
            ->where($movie['id'],'movie_id')
            ->andWhere($seat_data['date'],'date')
            ->andWhere($seat_data['time'],'show_time')
            ->get();

        $soldSeats = [];
        foreach($all_bookings as $booking){
            $booked_seats = explode(',',$booking['seats']);
            foreach($booked_seats as $st){
                $soldSeats[] = $st;
            }
        }

        $not_available_seats = [];

        foreach($seat_data['seats'] as $st){
            if(in_array($st,$soldSeats)){
                $not_available_seats[] = $st;
            }
        };

        if(count($not_available_seats) > 0){
            setError(implode(',',$not_available_seats). " are Not Available");
            return redirectBack();
        }

        // end checking

        $booking = $bookings->store([
            'user_id'=>$user['id'],
            'movie_id'=> "".$movie['id'],
            'date'=>$seat_data['date'],
            'show_time'=>$seat_data['time'],
            'seats'=> implode(',',$seat_data['seats']),
            'total'=> request('total'),
        ]);
        if($booking){
            deleteSeatData($movie_slug);
            return redirect('/bookings/step3');
        }else{
            setError("Sorry , Can't purchase . Try Again");
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
            $seats = explode(',',request('seats'));
            setSeatData($seats,request('movie_slug'),request('date'),request('time'));
        }else{
            deleteSeatData(request('movie_slug'));
        }
        echo request('seats');
    }

    public function getSeats()
    {
        $movie_id = request('movie_id');
        $movie_date = request('movie_date');
        $movie_time = request('movie_time');
        $bookings = new Booking();
        $soldSeats = $bookings->soldSeats($movie_id,$movie_date,$movie_time);
        echo json_encode($soldSeats);
    }
}
