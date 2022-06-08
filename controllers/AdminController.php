<?php
namespace controllers;

use models\Genere;
use models\Movie;
use models\ShowTime;

class AdminController
{
    public function index()
    {
        $movie_md = new Movie();
        $movies = $movie_md->getAll();
        // $showing = [];
        // $commingsoon = [];
        // $today_date =  Carbon::now();
        // foreach($movies as $movie){
        //     $start_date = new Carbon($movie['start_date']);
        //     $end_date = new Carbon($movie['end_date']);
        //     if($start_date > $today_date){
        //         $commingsoon[] = $movie;
        //     }
        //     // else if($end_date < $today_date){
        //     //     if movie was showed
        //     //     i did't implement because when you look up this project
        //     //     all movies will done
        //     // }
        //     else{
        //         $showing[] = $movie;
        //     }
        // }

        return view('admin/index',[
            'movies' => $movies
        ]);
    }

    public function edit()
    {
        $slug = request('slug');
        $movie_md = new Movie();
        $movie = $movie_md->where($slug,'slug')->getOne();
        $time_md = new ShowTime();
        $times = $time_md->getAll();
        $show_times = $movie_md->times($movie['id']);
        $genere_md = new Genere();
        $generes = $genere_md->getAll();
        $movie_generes = $movie_md->generes($movie['id']);
        return view('admin/edit',[
            'movie' => $movie,
            'times' => $times,
            'show_times' => $show_times,
            'generes' => $generes,
            'movie_generes' => $movie_generes
        ]);
    }

    public function create()
    {
        $time_md = new ShowTime();
        $times = $time_md->getAll();
        $genere_md = new Genere();
        $generes = $genere_md->getAll();
        return view('admin/create',[
            'times' => $times,
            'generes' => $generes
        ]);
    }

    public function store()
    {
        $request = request();
        $times = $request['times'];
        $generes = $request['generes'];
        unset($request['times']);
        unset($request['generes']);

        $movie_md = new Movie();        
        $new_movie = $movie_md->store($request);

        if($new_movie){
            $_SESSION["success"] = $new_movie['name']." was successfully added .";
            return redirect('/admin');
        }else{
            setError([
                "message" => "Something Wrong",
            ]);
            return redirectBack();
        }
    }

    public function update()
    {
        $movie_md = new Movie(); 
        
        $request = request();
        $times = $request['times']; 
        $generes = $request['generes'];
        unset($request['times']);
        unset($request['generes']);
        
        $movie_md->syncTimes($request['id'],$times);
        $movie_md->syncGeneres($request['id'],$generes);
        $update_movie = $movie_md->update($request['id'],$request);
              

        if($update_movie){
            $_SESSION["success"] = $update_movie['name']." was successfully updated .";
            return redirect('/admin');
        }else{
            setError([
                "message" => "Something Wrong",
            ]);
            return redirectBack();
        }
    }
}