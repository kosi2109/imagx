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

}