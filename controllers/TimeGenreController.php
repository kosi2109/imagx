<?php
namespace controllers;


use models\Genre;
use models\ShowTime;

class TimeGenreController
{
    public function index()
    {
        $times = new ShowTime();
        $genres = new Genre();
        $times = $times->getAll();
        $genres = $genres->getAll();
        return view('admin/timegenre',[
            'times' => $times,
            'genres' => $genres
        ]);
    }

    public function destroy ()
    {
        $type = request('type');
        $id = request('id');
        if(!$type || !$id){
            return redirectBack();
        }

        if($type == "time"){
            $time_md = new ShowTime();
            $time_md->delete($id);
            $_SESSION['success'] = "Successfully Deleted";
            return redirectBack();
        }elseif($type == "genre"){
            $genre_md = new Genre();
            $genre_md->delete($id);
            $_SESSION['success'] = "Successfully Deleted";
            return redirectBack();
        }else{
            setError("Can't delete");
            return redirectBack();
        }

    }
   
    public function update ()
    {
        $type = request('type');
        $id = request('id');
        $newvalue = request('name');
        if(!$type || !$id){
            return redirectBack();
        }

        if($type == "time"){
            $time_md = new ShowTime();
            $time_md->update($id,['show_time'=>$newvalue]);
            $_SESSION['success'] = "Successfully Updated";
            return redirectBack();
        }elseif($type == "genre"){
            $genre_md = new Genre();
            $genre_md->update($id,['genre'=>$newvalue]);
            $_SESSION['success'] = "Successfully Updated";
            return redirectBack();
        }else{
            setError("Can't update item");
            return redirectBack();
        }

    }

    public function store ()
    {
        $type = request('type');
        $value = request('value');
        if(!$type || !$value){
            return redirectBack();
        }

        if($type == "time"){
            $time_md = new ShowTime();
            $time_md->store(['show_time'=>$value]);
            $_SESSION['success'] = "Successfully Added";
            return redirectBack();
        }elseif($type == "genre"){
            $genre_md = new Genre();
            $genre_md->store(['genre'=>$value]);
            $_SESSION['success'] = "Successfully Added";
            return redirectBack();
        }else{
            setError("Can't Add");
            return redirectBack();
        }

    }
    
}