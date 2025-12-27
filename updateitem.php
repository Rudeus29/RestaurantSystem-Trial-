<?php
require_once("pdo.php");

$id = trim($_POST["id"]);
$state = trim($_POST["state"]);
$category = trim($_POST["category"]);
$name = trim($_POST["name"]);
$price = trim($_POST["price"]);

$stmt = $pdo->prepare('
    UPDATE `sitem` SET
    state = :state,
    category = :category,
    name = :name,
    price = :price
    WHERE id = :id;
');
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->bindValue(":state", $state, PDO::PARAM_INT);
$stmt->bindValue(":category", $category, PDO::PARAM_INT);
$stmt->bindValue(":name", $name, PDO::PARAM_STR);
$stmt->bindValue(":price", $price, PDO::PARAM_INT);

$stmt->execute();

header("Location: managementitem.php");
?>