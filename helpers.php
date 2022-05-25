<?php
declare (strict_types = 1);

function dd($something) : void
{
    var_dump($something);
    die();
} 

function view(string $html,array $params = []) : void
{
    $path = __DIR__ . "/views/$html.php";
    if(!file_exists($path)){
        var_dump("$path not found");
        return;
    }
    foreach($params as $key=>$value){
        $$key = $value;
    };
    require_once $path;
}

function request() : array
{
    $method = $_SERVER["REQUEST_METHOD"];
    if($method == "GET" && count($_GET) > 0){
        return $_GET;
    }elseif($method == "POST" && count($_POST) > 0){
        return $_POST;
    }
}


function uriParser(string $uri) :string
{
    return parse_url(trim($uri,'/'),PHP_URL_PATH);
}


function asset(string $path) : string
{
    $path = "../../public/$path" ;
    return $path;
}