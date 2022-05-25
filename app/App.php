<?php
declare (strict_types = 1);

namespace app;
use app\Route;


class App
{
    public static $pdo;
    public function __construct($pdo)
    {
        self::$pdo = $pdo;
    }
    public function boot() : void
    {
        $uri = uriParser($_SERVER["REQUEST_URI"]);
        if($uri == ""){
            $uri = "/";
        }
        $route = new Route();
        $route::bild($uri,$_SERVER["REQUEST_METHOD"]);
    }
    public static function getDbConnection ()
    {
        return self::$pdo;
    }
}
