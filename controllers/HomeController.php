<?php
namespace controllers;

use models\Movie;

class HomeController
{
    public function index()
    {
        $movie = new Movie();
        $movies = $movie->where("id","=",1)->get();
        return view('index',[
            "movies" => $movies
        ]);
    }

}