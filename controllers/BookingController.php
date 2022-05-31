<?php

namespace controllers;

use models\Movie;

class BookingController
{
    public function booking()
    {
        $selected_seats = $_SESSION['seat_data']['venom'];
        return view('booking',[
            'selected_seat' => json_encode($selected_seats)
        ]);
    }

    public function purchase()
    {
        $seats = $_SESSION['seat_data']['venom'];
        if(!$seats){
            return redirectBack();
        }
        $movies = new Movie();
        $movie = $movies->where('1')->getOne();
        $new_seats = [];
        foreach ($seats as $st) {
            if($st !== ""){
                $new_seats[$st[0]][] = $st;
            }
        }
        
        return view('purchase', [
            "movie" => $movie,
            "seats" => $new_seats,
        ]);
    }

    public function complete()
    {
        return view('purchaseComplete');
    }

    public function seatHandler()
    {
        if(request('seats')){
            $_SESSION['seat_data'][request('movie')] = explode(',',request('seats'));
        }else{
            unset($_SESSION['seat_data'][request('movie')]);
        }
    }
}
