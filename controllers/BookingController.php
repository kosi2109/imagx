<?php
namespace controllers;


class BookingController
{
    public function booking()
    {
        return view('booking');
    }

    public function purchase()
    {
        return view('purchase');
    }

    public function complete()
    {
        return view('purchaseComplete');
    }

}