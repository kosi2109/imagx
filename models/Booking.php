<?php

namespace models;

use app\App;
use app\Model;

// if your table and model name is not same just put table name in setTable method 

class Booking extends Model
{
    public function __construct()
    {
        $this->setPDO(App::getDbConnection());
        $this->setTabel($this->getTableNameFromClassName());
    }

    public function soldSeats(string $id,string $date , string $time) : array
    {
        $statement = $this->pdo->prepare("SELECT seats FROM bookings  
                                        WHERE (movie_id = :id AND show_time = :show_time AND date = :date )");
        $statement->bindValue(':id',$id);
        $statement->bindValue(':show_time',$time);
        $statement->bindValue(':date',$date);
        $statement->execute();
        $seats = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $seatsArray = [];
        foreach($seats as $seat){
            foreach(explode(',',$seat['seats']) as $s){
                $seatsArray[] = $s;
            }
        }
        return $seatsArray;
    }

    public function myOrder(string $user_id) : array
    {
        $statement = $this->pdo->prepare("SELECT bookings.id,bookings.show_time,bookings.date,                              
                                        bookings.seats,movies.name as movie_name
                                        FROM bookings 
                                        INNER JOIN movies 
                                        ON bookings.movie_id = movies.id 
                                        WHERE bookings.user_id = :id ");
        $statement->bindValue(':id',$user_id);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);                                                    
    }

    public function orders(?string $date = null , ?string $time = null , ?string $mid = null)
    {
        $query = "SELECT bookings.id,bookings.show_time,bookings.date,                              
                bookings.seats,bookings.total,movies.name as movie_name,users.username
                FROM bookings 
                INNER JOIN movies 
                ON bookings.movie_id = movies.id 
                INNER JOIN users 
                ON bookings.user_id = users.id";
        
        if($mid || $date || $time){
            $query .= " WHERE " ;
        }

        if ($mid){
            $query .= "bookings.movie_id = :mid AND ";
        }

        if($date){
            $query .= "bookings.date = :date AND ";
        }

        if($time){
            $query .= "bookings.show_time = :time AND ";
        }

        if($mid || $date || $time){
            $query = rtrim($query," AND ");
        }

        $statement = $this->pdo->prepare($query);

        if ($mid){
            $statement->bindValue(':mid',$mid); 
        }

        if($date){
            $statement->bindValue(':date',$date);
        }

        if($time){
            $statement->bindValue(':time',$time);
        }   
                                       
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);                                                    
    }

}