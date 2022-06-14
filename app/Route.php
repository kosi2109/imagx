<?php
declare (strict_types = 1);

namespace app;

class Route
{
    protected static array $routes =[];

    public function __construct()
    {
        
    }

    // call method or function on uri
    public static function bild(string $uri, string $method = "GET") : void
    {
        if(isset(self::$routes[$method][$uri])){
            if (is_callable(self::$routes[$method][$uri])){
                self::$routes[$method][$uri]();
                return;
            }else{
                [$class,$method] = self::$routes[$method][$uri];
                $controller = new $class;
                $controller->$method();  
                return;  
            }
        }else{
            //404
            view("error");
        }
    }
    

    public static function get(string $uri , callable|array $callback) : void
    {
        if($uri != "/"){
            $uri = uriParser($uri);
        }
        if(is_callable($callback)){
            self::$routes['GET'][$uri] = $callback;       
            return; 
        }
        [$class , $method] = $callback;
        $controller = new $class;
        if(method_exists($controller,$method)){
            self::$routes['GET'][$uri] = $callback;    
            return;       
        }   
    }

    public static function post(string $uri , callable|array $callback) :void
    {
        $uri = uriParser($uri);
        if(is_callable($callback)){
            self::$routes['POST'][$uri] = $callback;        
            return;
        }
        [$class , $method] = $callback;
        $controller = new $class;
        if(method_exists($controller,$method)){
            self::$routes['POST'][$uri] = $callback;
            return;           
        }   
    }

}