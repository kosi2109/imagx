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

    public function times(string $id)
    {
        $statement = $this->pdo->prepare("SELECT movies_show_times.id,show_time FROM movies_show_times 
                                        INNER JOIN show_times 
                                        ON show_times.id = movies_show_times.show_time_id 
                                        WHERE movies_show_times.movie_id = :id");
        $statement->bindValue(':id',$id);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
