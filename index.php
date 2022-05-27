<?php
session_start();
require "./vendor/autoload.php";
use app\DB;
use app\App;
use app\Config;
use Dotenv\Dotenv;
$dotenv = Dotenv::createMutable(__DIR__);
$dotenv->load();

require_once "./helpers.php";
require_once "./routes/routers.php";

$config = new Config();
$db = new DB($config->getDataBaseConfig());
$pdo = $db->connect();
$app = new App($pdo);
$app->boot();
