<?php
declare (strict_types = 1);

namespace app;

class DB
{
    public function __construct(private array $config)
    {
        
    }

    public function connect()
    {
        $str = $this->config['DB_TYPE']. ':host=' .$this->config['DB_HOST']. ';
        dbname='.$this->config['DB_NAME'];
        try{
            return new \PDO($str,$this->config['DB_USERNAME'],$this->config['DB_PASSWORD']);
        }catch(\PDOException $e){
            echo $e->getMessage();
        }
    }
}