<?php
namespace controllers;

use models\Genre;
use models\Movie;
use models\ShowTime;

class AdminMovieController
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
        $genre_md = new genre();
        $genres = $genre_md->getAll();
        $movie_genres = $movie_md->genres($movie['id']);
        return view('admin/edit',[
            'movie' => $movie,
            'times' => $times,
            'show_times' => $show_times,
            'genres' => $genres,
            'movie_genres' => $movie_genres
        ]);
    }

    public function create()
    {
        $time_md = new ShowTime();
        $times = $time_md->getAll();
        $genre_md = new Genre();
        $genres = $genre_md->getAll();
        return view('admin/create',[
            'times' => $times,
            'genres' => $genres
        ]);
    }

    public function store()
    {
        $request = request();
        $times = $request['times'];
        $genres = $request['genres'];
        unset($request['times']);
        unset($request['genres']);

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
        $genres = $request['genres'];
        unset($request['times']);
        unset($request['genres']);
        
        $movie_md->syncTimes($request['id'],$times);
        $movie_md->syncgenres($request['id'],$genres);
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

    public function destroy()
    {
        $id = request('movie_id');
        if(!$id){
            setError([
                'message' => "Missing some data"
            ]);
            return redirectBack();
        }
        $movie_md = new Movie();
        $movie = $movie_md->where($id)->getOne();
        if(!$movie){
            setError([
                'message' => "Movie Not Found"
            ]);
            return redirectBack();
        }
        $deleted = $movie_md->delete($id);
        if($deleted){
            $_SESSION['success'] = $movie['name'] . "was successfully deleted";
            return redirect('/admin');
        }else{
            setError([
                'message' => "Something went wrong"
            ]);
            return redirectBack();
        }

    }

    
}