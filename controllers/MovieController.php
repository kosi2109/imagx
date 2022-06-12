<?php
namespace controllers;

use Carbon\Carbon;
use models\Movie;

class MovieController
{
    public function index()
    {
        $movie_md = new Movie();
        $movies = $movie_md->getAll();
        $showing = [];
        $commingsoon = [];
        $today_date =  Carbon::now();
        foreach($movies as $movie){
            $start_date = new Carbon($movie['start_date']);
            $end_date = new Carbon($movie['end_date']);
            if($start_date > $today_date){
                $commingsoon[] = $movie;
            }
            // else if($end_date < $today_date){
            //     if movie was showed
            //     i did't implement because when you look at this project
            //     all movies will gone
            // }
            else{
                $showing[] = $movie;
            }
        }

        return view('movies',[
            'showing' => $showing,
            'comming_soon' => $commingsoon
        ]);
    }
}