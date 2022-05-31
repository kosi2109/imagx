<?php
declare(strict_types=1);
namespace app;
use app\QueryBuilder;

class Model extends QueryBuilder
{
    public function __construct()
    {
    }

    protected function setPDO($pdo)
    {
        $this->pdo = $pdo;
    }
    
    protected function setTabel($table)
    {
        $this->table = $table;
    }

    // to get table name 
    protected function getTableNameFromClassName() : string
    {
        $abs_path = explode('\\',get_class($this)) ;
        return strtolower($abs_path[array_key_last($abs_path)]) ."s";
    }
}