<?php
namespace controllers;

use Carbon\Carbon;
use models\Movie;

class ScheduleController
{
    public function index()
    {
        $today =  new Carbon();
        $today = $today->today()->format('Y-m-d');
        $movie_md = new Movie();
        // only movies that can book today 
        $movies = $movie_md->where($today,'can_book_at',"<=")->get();

        $movies = array_map(function($movie) use($movie_md){
            $times = $movie_md->times($movie['id']);
            $times = array_map(function($time){
                $format_time = new Carbon($time['show_time']);
                $time['show_time'] = $format_time->format('g:i A');
                return $time;
            },$times);
            
            $movie['times'] = $times;
            return $movie;
        },$movies);
        return view('schedule',[
            'movies' => $movies
        ]);
    }
}