<?php
declare (strict_types = 1);
namespace app;

class QueryBuilder
{
    protected $pdo;
    protected $table;
    protected $query;
    protected $columns;
    public function __construct()
    {   
        
    }

    public function getColumns()
    {
        $statement = $this->pdo->prepare("DESCRIBE $this->table");
        $statement->execute();
        $this->columns = $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function getAll()
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public function where($value, ?string $column = 'id' , ?string $operator = '=') 
    {
        $this->query = "SELECT * FROM $this->table WHERE $column $operator '$value' ";
        return $this;
    }

    public function get()
    {
        $statement = $this->pdo->prepare($this->query);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getOne()
    {
        $statement = $this->pdo->prepare($this->query);
        $statement->execute();
        return $statement->fetch();
    }

    public function store(?array $values = null)
    {
        if($values == null){
            return;
        }

        $this->getColumns();
        $columns = "";
        $query_string = "";
        foreach($this->columns as $column){
            if($column != "id"){
                $query_string .= ":$column, ";
                $columns .= "$column, ";
            }
        }
        $columns = rtrim($columns, ", ");
        $query_string = rtrim($query_string, ", ");
        $statement = $this->pdo->prepare("INSERT INTO $this->table ($columns) VALUES ($query_string)");

        foreach($values as $key=>$value){
            $statement->bindValue(":$key",$value);
        }
        $statement->execute();
        var_dump("Done");
    }
}