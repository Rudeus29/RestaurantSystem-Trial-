<?php
$host = 'localhost';
$dbname = "SkyRestaurant";
$user = "root";
$pass = "";

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "db connection error" . $e->getMessage();
    exit;
}