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

function request(string $variable = null)
{
    $method = $_SERVER["REQUEST_METHOD"];
    if($variable == null){
        if($method == "GET" && count($_GET) > 0){
            $get = array_map(function($g){
                return htmlspecialchars($g);
            },$_GET);
            return $get;
        }elseif($method == "POST" && count($_POST) > 0){
            $post = array_map(function($g){
                return htmlspecialchars($g);
            },$_POST);
            return $post;
        }
    }else{
        if($method == "GET" && count($_GET) > 0){
            return htmlspecialchars($_GET[$variable]);
        }elseif($method == "POST" && count($_POST) > 0){
            return htmlspecialchars($_POST[$variable]);
        }
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

function redirect(?string $uri = '/') : void
{
    header("Location: $uri");
}

function redirectBack(?array $values = []) : void
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function setError ($value)
{
    $_SESSION['error'] = $value;
}

function error ($key)
{
    return $_SESSION['error'][$key];
}