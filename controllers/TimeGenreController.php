<?php
namespace controllers;


use models\Genre;
use models\ShowTime;

class TimeGenreController
{
    public function index()
    {
        !is_admin() && redirectBack() ; 
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
        !is_admin() && redirectBack() ; 
        $type = request('type');
        $id = request('id');
        if(!$type || !$id){
            return redirectBack();
        }

        if($type == "time"){
            $time_md = new ShowTime();
            $time_md->delete($id);
            setSuccess("Successfully Deleted");
            return redirectBack();
        }elseif($type == "genre"){
            $genre_md = new Genre();
            $genre_md->delete($id);
            setSuccess("Successfully Deleted");
            return redirectBack();
        }else{
            setError("Can't delete");
            return redirectBack();
        }

    }
   
    public function update ()
    {
        !is_admin() && redirectBack() ; 
        $type = request('type');
        $id = request('id');
        $newvalue = request('name');
        if(!$type || !$id){
            return redirectBack();
        }

        if($type == "time"){
            $time_md = new ShowTime();
            $time_md->update($id,['show_time'=>$newvalue]);
            setSuccess("Successfully Updated");
            return redirectBack();
        }elseif($type == "genre"){
            $genre_md = new Genre();
            $genre_md->update($id,['genre'=>$newvalue]);
            setSuccess("Successfully Updated");
            return redirectBack();
        }else{
            setError("Can't update item");
            return redirectBack();
        }

    }

    public function store ()
    {
        !is_admin() && redirectBack() ; 
        $type = request('type');
        $value = request('value');
        if(!$type || !$value){
            return redirectBack();
        }

        if($type == "time"){
            $time_md = new ShowTime();
            $time_md->store(['show_time'=>$value]);
            setSuccess("Successfully Added");
            return redirectBack();
        }elseif($type == "genre"){
            $genre_md = new Genre();
            $genre_md->store(['genre'=>$value]);
            setSuccess("Successfully Added");
            return redirectBack();
        }else{
            setError("Can't Add");
            return redirectBack();
        }

    }
    
}