<?php

declare(strict_types=1);

function dd($something): void
{
    var_dump($something);
    die();
}

function view(string $html, array $params = []): void
{
    $path = __DIR__ . "/views/$html.php";
    if (!file_exists($path)) {
        var_dump("$path not found");
        return;
    }
    foreach ($params as $key => $value) {
        $$key = $value;
    };
    require_once $path;
    clear_temp_session();
}

function clear_temp_session(): void
{
    unset($_SESSION['old']);
    unset($_SESSION['error']);
    unset($_SESSION['success']);
}

function request(?string $variable = null) : array | string | int
{
    $method = $_SERVER["REQUEST_METHOD"];
    if ($variable == null) {
        if ($method == "GET" && count($_GET) > 0) {
            $get = array_map(function ($g) {
                return htmlspecialchars($g);
            }, $_GET);
            return $get;
        } elseif ($method == "POST" && count($_POST) > 0) {
            $post = array_map(function ($g) {
                return htmlspecialchars($g);
            }, $_POST);
            return $post;
        }
    } else {
        if ($method == "GET" && count($_GET) > 0 && $_GET[$variable] != null) {
            return htmlspecialchars($_GET[$variable]);
        } elseif ($method == "POST" && count($_POST) > 0 && $_POST[$variable] != null) {
            return htmlspecialchars($_POST[$variable]);
        }
    }
}


function uriParser(string $uri): string
{
    return parse_url(trim($uri, '/'), PHP_URL_PATH);
}


function asset(string $path): string
{
    $path =  "../../public/$path";
    return $path;
}

function redirect(?string $uri = '/'): void
{
    header("Location: $uri");
}

function redirectBack(): void
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


function setOld(array $array)
{
    foreach ($array as $key => $value) {
        $_SESSION['old'][$key] = $value;
    }
}

function old(string | int $key) : string | int
{
    $temp = $_SESSION['old'][$key];
    return $temp;
}

function setError($value) 
{
    $_SESSION['error'] = $value;
}

function error(string | int $key) : string | int
{
    return $_SESSION['error'][$key];
}

function renderSeats(string $seat_no, string $movie = "venom")
{
    $selected_seats = $_SESSION['seat_data'][$movie];
    
    if(!$selected_seats){
        return '/assets/seat.png';
    }

    $bo = '/assets/seat.png';
    foreach ($selected_seats as $seat) {
        if ($seat_no == $seat) {
            $bo = '/assets/available.png';
            break;
        }
    }
    return $bo;
}
