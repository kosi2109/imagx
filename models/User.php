<?php

namespace models;
use app\App;
use app\Model;

// if your table and model name is not same just put table name in setTable method 

class User extends Model
{
    public function __construct()
    {
        $this->setPDO(App::getDbConnection());
        $this->setTabel($this->getTableNameFromClassName());
    }

}