<?php
// this script will add database tables need for this pj
require "./vendor/autoload.php";

use app\Config;
use app\DB;
use Dotenv\Dotenv;

$dotenv = Dotenv::createMutable(__DIR__);
$dotenv->load();

$config = new Config();
$db = new DB($config->getDataBaseConfig());
$pdo = $db->connect();

// user table
$statement = $pdo->prepare("CREATE TABLE `users` (
    `id` int NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `full_name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `is_admin` tinyint(1) DEFAULT '0',
    PRIMARY KEY (`id`)
  ) AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

$statement->execute();


$statement = $pdo->prepare("CREATE TABLE `show_times` (
    `id` int NOT NULL AUTO_INCREMENT,
    `show_time` time NOT NULL,
    PRIMARY KEY (`id`)
  ) AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

$statement->execute();


$statement = $pdo->prepare("CREATE TABLE `movies_show_times` (
    `id` int NOT NULL AUTO_INCREMENT,
    `movie_id` int NOT NULL,
    `show_time_id` int NOT NULL,
    PRIMARY KEY (`id`)
  ) AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

$statement->execute();

$statement = $pdo->prepare("CREATE TABLE `movies_genres` (
    `id` int NOT NULL AUTO_INCREMENT,
    `movie_id` int NOT NULL,
    `genre_id` int NOT NULL,
    PRIMARY KEY (`id`)
  ) AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

$statement->execute();


$statement = $pdo->prepare("CREATE TABLE `genres` (
    `id` int NOT NULL AUTO_INCREMENT,
    `genre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    PRIMARY KEY (`id`)
  ) AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

$statement->execute();


$statement = $pdo->prepare("CREATE TABLE `bookings` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `movie_id` int NOT NULL,
    `date` date NOT NULL,
    `show_time` time NOT NULL,
    `seats` varchar(255) NOT NULL,
    `total` int NOT NULL,
    PRIMARY KEY (`id`)
  ) AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

$statement->execute();


$statement = $pdo->prepare("CREATE TABLE `movies` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(100) COLLATE utf8mb4_da_0900_as_cs NOT NULL,
    `casts` text COLLATE utf8mb4_da_0900_as_cs NOT NULL,
    `movie_pg` varchar(255) COLLATE utf8mb4_da_0900_as_cs NOT NULL,
    `start_date` date NOT NULL,
    `end_date` date NOT NULL,
    `can_book_at` date DEFAULT NULL,
    `movie_img` varchar(255) COLLATE utf8mb4_da_0900_as_cs NOT NULL,
    `director` varchar(255) COLLATE utf8mb4_da_0900_as_cs NOT NULL,
    `runtime` varchar(100) COLLATE utf8mb4_da_0900_as_cs NOT NULL,
    `slug` varchar(255) COLLATE utf8mb4_da_0900_as_cs NOT NULL,
    PRIMARY KEY (`id`)
  ) AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_da_0900_as_cs;");

$statement->execute();