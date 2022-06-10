<?php

namespace models;

use app\App;
use app\Model;

// table name should be lowercase and plural
// if your table and model name is not same just put table name in setTable method 

class Movie extends Model
{
    public function __construct()
    {
        $this->setPDO(App::getDbConnection());
        $this->setTabel($this->getTableNameFromClassName());
    }

    public function times(string $id) : array
    {
        $statement = $this->pdo->prepare("SELECT show_times.id,show_time FROM movies_show_times 
                                        INNER JOIN show_times 
                                        ON show_times.id = movies_show_times.show_time_id 
                                        WHERE movies_show_times.movie_id = :id");
        $statement->bindValue(':id',$id);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function genres(string $id) : array
    {
        $statement = $this->pdo->prepare("SELECT genres.id,genre FROM movies_genres 
                                        INNER JOIN genres 
                                        ON genres.id = movies_genres.genre_id 
                                        WHERE movies_genres.movie_id = :id");
        $statement->bindValue(':id',$id);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function syncTimes(string $movie_id,array | null $times)
    {
        if($times == null){
            $statement = $this->pdo->prepare("DELETE FROM movies_show_times WHERE movie_id = :movie_id");
            $statement->bindValue(':movie_id',$movie_id);
            $statement->execute();
            return;
        }
        $show_time_md = new ShowTime();
        $show_times = $show_time_md->getAll();
        $show_times = array_map(function($ti){
            return ''.$ti['id'];
        },$show_times);
        
        foreach($show_times as $show_time){
            $is_exist = in_array($show_time,$times);
            $statement = $this->pdo->prepare("SELECT * FROM movies_show_times WHERE movie_id = :movie_id AND show_time_id = :show_time_id");
            $statement->bindValue(':movie_id',$movie_id);
            $statement->bindValue(':show_time_id',$show_time);
            $statement->execute();
            $exit_in_db = $statement->fetch(\PDO::FETCH_ASSOC);
            if($is_exist){
                if(!$exit_in_db){
                    $statement = $this->pdo->prepare("INSERT INTO movies_show_times (movie_id,show_time_id) VALUES (:movie_id,:show_time_id)");
                    $statement->bindValue(':movie_id',$movie_id);
                    $statement->bindValue(':show_time_id',$show_time);
                    $statement->execute();
                }
            }else{
                if($exit_in_db){
                    $statement = $this->pdo->prepare("DELETE FROM movies_show_times WHERE movie_id = :movie_id AND show_time_id = :show_time_id");
                    $statement->bindValue(':movie_id',$movie_id);
                    $statement->bindValue(':show_time_id',$show_time);
                    $statement->execute();
                }
            }
        }
    }

    public function syncgenres(string $movie_id,array | null $genres)
    {
        if($genres == null){
            $statement = $this->pdo->prepare("DELETE FROM movies_genres WHERE movie_id = :movie_id");
            $statement->bindValue(':movie_id',$movie_id);
            $statement->execute();
            return;
        }

        $genres_md = new Genre();
        $all_genres = $genres_md->getAll();
        $all_genres = array_map(function($ti){
            return ''.$ti['id'];
        },$all_genres);
        
        foreach($all_genres as $genre){
            $is_exist = in_array($genre,$genres);
            $statement = $this->pdo->prepare("SELECT * FROM movies_genres WHERE movie_id = :movie_id AND genre_id = :genre_id");
            $statement->bindValue(':movie_id',$movie_id);
            $statement->bindValue(':genre_id',$genre);
            $statement->execute();
            $exit_in_db = $statement->fetch(\PDO::FETCH_ASSOC);
            if($is_exist){
                if(!$exit_in_db){
                    $statement = $this->pdo->prepare("INSERT INTO movies_genres (movie_id,genre_id) VALUES (:movie_id,:genre_id)");
                    $statement->bindValue(':movie_id',$movie_id);
                    $statement->bindValue(':genre_id',$genre);
                    $statement->execute();
                }
            }else{
                if($exit_in_db){
                    $statement = $this->pdo->prepare("DELETE FROM movies_genres WHERE movie_id = :movie_id AND genre_id = :genre_id");
                    $statement->bindValue(':movie_id',$movie_id);
                    $statement->bindValue(':genre_id',$genre);
                    $statement->execute();
                }
            }
        }
    }
}
