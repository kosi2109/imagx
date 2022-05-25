<?php

namespace models;
use app\Model;

// if your table and model name is not same just put table name in setTable method 

class Booking extends Model
{
    public function __construct()
    {
        $this->setTabel($this->getTableNameFromClassName());
    }

}