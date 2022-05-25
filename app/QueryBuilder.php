<?php
declare (strict_types = 1);
namespace app;

class QueryBuilder
{
    protected $pdo;
    protected $table;
    protected $query;
    public function __construct()
    {   

    }

    public function getAll()
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public function where(string $column = "id" , string $operator = "=" , $value) 
    {
        $this->query = "SELECT * FROM $this->table WHERE $column $operator $value";
        return $this;
    }

    public function get()
    {
        $statement = $this->pdo->prepare($this->query);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }
}