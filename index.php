<?php
declare(strict_types=1);

session_start();
require "./vendor/autoload.php";
use app\DB;
use app\App;
use app\Config;
use Dotenv\Dotenv;
$dotenv = Dotenv::createMutable(__DIR__);
$dotenv->load();

require_once "./helpers.php";
require_once "./utils.php";
require_once "./routes/routers.php";

$config = new Config();
// i don't want to initalize pdo again and agin so I bild one to app
$db = new DB($config->getDataBaseConfig());
$pdo = $db->connect();
$app = new App($pdo);
$app->boot();
