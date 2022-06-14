<?php
namespace controllers;

use models\Genre;
use models\Movie;
use models\ShowTime;

class AdminMovieController
{
    public function index()
    {
        !is_admin() && redirectBack() ; 
        $movie_md = new Movie();
        $movies = $movie_md->getAll();

        return view('admin/index',[
            'movies' => $movies
        ]);
    }

    public function edit()
    {
        !is_admin() && redirectBack(); 
        $slug = request('slug');
        $movie_md = new Movie();
        $movie = $movie_md->where($slug,'slug')->getOne();
        if(!$movie){
            return redirectBack();
        }
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
        !is_admin() && redirectBack(); 
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
        !is_admin() && redirectBack() ; 
        $request = request();
        setOld(request());
        if(!request('use_url')){
            $img = storage($_FILES['movie_img']);
            $request['movie_img'] = $img;
        }
        $times = $request['times'];
        $genres = $request['genres'];
        $movie_md = new Movie();
                
        unset($request['times']);
        unset($request['genres']);
        unset($request['use_url']);

        $request['slug'] = trim($request['slug']); 
        $new_movie = $movie_md->store($request);
        if(!$new_movie){    
            setError("Something Wrong");
            return redirectBack();
        }
        $genre = $movie_md->syncgenres($new_movie['id'],$genres);
        $time = $movie_md->syncTimes($new_movie['id'],$times);
        if($genre && $time){
            setSuccess($new_movie['name']." was successfully added .");
            return redirect('/admin/view-movies');
        }else{
            setOld(request());
            setError("Something Wrong");
            return redirectBack();
        }
    }

    public function update()
    {
        !is_admin() && redirectBack();
        
        if(request('start_date') >= request('end_date')){
            setError("End Date must greater than start date");
            return redirectBack();
        }
        $movie_md = new Movie(); 
        $request = request();
        $times = $request['times']; 
        $genres = $request['genres'];

        if(!request('use_url')){
            $img = storage($_FILES['movie_img']);
            $request['movie_img'] = $img;
        }
        // times and genres tables are sprit so we don't need here
        unset($request['times']);
        unset($request['genres']);
        unset($request['use_url']);

        
        // add data to times and genre table base on movie
        $movie_md->syncTimes($request['id'],$times);
        $movie_md->syncgenres($request['id'],$genres);

        $request['slug'] = trim($request['slug']); 
        $update_movie = $movie_md->update($request['id'],$request);
              
        if($update_movie){
            setSuccess($update_movie['name']." was successfully updated .");
            return redirect("/admin/edit-movie?slug=".$update_movie['slug']);
        }else{
            setError("Something Wrong");
            return redirectBack();
        }
    }

    public function destroy()
    {
        !is_admin() && redirectBack(); 
        $id = request('movie_id');
        if(!$id){
            setError("Missing some data");
            return redirectBack();
        }
        $movie_md = new Movie();
        $movie = $movie_md->where($id)->getOne();
        if(!$movie){
            setError("Movie Not Found");
            return redirectBack();
        }
        $deleted = $movie_md->delete($id);
        if($deleted){
            setSuccess($movie['name'] . "was successfully deleted");
            return redirect('/admin/view-movies');
        }else{
            setError("Something went wrong");
            return redirectBack();
        }

    }

    
}