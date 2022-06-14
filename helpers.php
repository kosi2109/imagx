<?php

declare(strict_types=1);

use models\User;

function auth(): array | bool
{
    $auth = isset($_SESSION['auth']);
    if (!$auth) {
        return false;
    }

    return $_SESSION['auth'];
}

function dd($something): void
{
    var_dump($something);
    die();
}

// return view and parameter for that view
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

// get all request and return data on request method and uri
function request(?string $variable = null): array | string | int | bool
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
                if (is_array($g)) {
                    foreach ($g as $i) {
                        htmlspecialchars($i);
                    }
                    return $g;
                }
                return htmlspecialchars($g);
            }, $_POST);
            return $post;
        }
    } else if (isset($_GET[$variable]) | isset($_POST[$variable])) {
        if ($method == "GET") {
            return htmlspecialchars($_GET[$variable]);
        } elseif ($method == "POST") {
            return htmlspecialchars($_POST[$variable]);
        }
    } else {
        return false;
    }
}

// url parse for absolute url
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
    if (!isset($_SERVER['HTTP_REFERER'])) {
        header('Location: /');
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}


function setOld(array $array)
{
    foreach ($array as $key => $value) {
        $_SESSION['old'][$key] = $value;
    }
}

// when form is fail get old value from fail
function old(string | int $key): string | int | null | array
{
    $temp = $_SESSION['old'][$key];
    return $temp;
}

function setError($value)
{
    $_SESSION['error'][] = $value;
}

function error()
{
    if (!isset($_SESSION['error'])) {
        return false;
    }
    return $_SESSION['error'];
}

function setSuccess($value)
{
    $_SESSION['success'][] = $value;
}

function success()
{
    if (!isset($_SESSION['success'])) {
        return false;
    }
    return $_SESSION['success'];
}

function login_required()
{
    $auth = auth();
    if (!$auth) {
        redirectBack();
    }
}

function is_admin()
{
    $auth = auth();
    if (!$auth) {
        return false;
    }

    $user = new User();
    $user = $user->where($auth['username'], 'username')->getOne();
    if (!$user['is_admin']) {
        return false;
    }
    return true;
}

// get seats base on movie time and date
function setSeatData(array $seats, string $movie_slug, $date, $time): void
{
    $_SESSION['seat_data'][$movie_slug]['seats'] = $seats;
    $_SESSION['seat_data'][$movie_slug]['date'] = $date;
    $_SESSION['seat_data'][$movie_slug]['time'] = $time;
}

function getSeatData(string $movie_slug): array | null
{
    return $_SESSION['seat_data'][$movie_slug];
}

function deleteSeatData(string $movie_slug): void
{
    unset($_SESSION['seat_data'][$movie_slug]);
}

// group seats by role like ['A'] => ['A1','A2']
function seatsByRole($seats)
{
    $new_seats = [];
    foreach ($seats as $st) {
        if ($st !== "") {
            $new_seats[$st[0]][] = $st;
        }
    }

    return $new_seats;
}


function storage($image)
{
    $path = "public/assets/movies/";

    if (!file_exists($path)) {
        mkdir($path);
    }

    $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        setError('File Type Not Support');
        return redirectBack();
    }

    if ($image["size"] > 500000) {
        setError('File Too Large');
        return redirectBack();
    }

    $target_file = $path . time() . ".$imageFileType";

    if (move_uploaded_file($image['tmp_name'], $target_file)) {
        return "/" . $target_file;
    }

    return redirectBack();
}
