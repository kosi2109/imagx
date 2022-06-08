<?php
namespace controllers;

use models\Booking;
use models\User;

class ProfileController
{
    public function index()
    {
        $auth = auth();
        if(!$auth){
            return redirectBack();
        }
        $bookings = new Booking();
        $users = new User();
        $user = $users->where($auth['username'],'username')->getOne();
        $bookings = $bookings->myOrder($user['id']);
        $bookings = array_map(function($booking){
            $seats = explode(',',$booking['seats']);
            // new array with same row key (['A']=>['A1','A2'])
            $new_seats = [];
            foreach ($seats as $st) {
                if($st !== ""){
                    $new_seats[$st[0]][] = $st;
                }
            }
            $booking['seats'] = $new_seats;
            return $booking;
        },$bookings);
        return view('profile/index',[
            'bookings' => $bookings
        ]);
    }

}