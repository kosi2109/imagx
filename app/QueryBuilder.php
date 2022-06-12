<?php

declare(strict_types=1);

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
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function where($value, ?string $column = 'id', ?string $operator = '=')
    {
        $this->query = "SELECT * FROM $this->table WHERE $column $operator '$value' ";
        return $this;
    }

    public function andWhere($value, ?string $column = 'id', ?string $operator = '=')
    {
        $this->query .= "AND $column $operator '$value' ";
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
        try {
            if ($values == null) {
                return;
            }

            $this->getColumns();
            $columns = "";
            $query_string = "";
            foreach ($this->columns as $column) {
                if ($column != "id") {
                    $query_string .= ":$column, ";
                    $columns .= "$column, ";
                }
            }
            $columns = rtrim($columns, ", ");
            $query_string = rtrim($query_string, ", ");
            $statement = $this->pdo->prepare("INSERT INTO $this->table ($columns) VALUES ($query_string)");

            foreach ($values as $key => $value) {
                $statement->bindValue(":$key", $value);
            }
            $statement->execute();
            return $this->where($this->pdo->lastInsertId())->getOne();
        } catch (\Throwable $th) {
            var_dump("err at add");
        }
    }

    public function update(string $id, array $values = null) 
    {
        try {
            if ($values == null) {
                return;
            }

            $this->getColumns();

            $query_string = "";
            foreach ($this->columns as $column) {
                if ($column != "id") {
                    $query_string .= "$column = :$column, ";
                }
            }

            $query_string = rtrim($query_string, ", ");
            $statement = $this->pdo->prepare("UPDATE $this->table SET $query_string WHERE id = :id");
            $statement->bindValue(':id', $id);
            foreach ($values as $key => $value) {
                if ($column != "id") {
                    $statement->bindValue(":$key", $value);
                }
            }
            $statement->execute();
            return $this->where($id)->getOne();
        } catch (\PDOException $th) {
            return false;
        }
    }

    public function delete(string $id)
    {
        try {
            $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
            $statement->bindValue(':id', $id);
            $statement->execute();
            return true;
        } catch (\PDOException $th) {
            return false;
        }
    }
}
