<?php
require_once("pdo.php");

$id = trim($_POST["categoryId"] ?? "商品名未入力");
$name = trim($_POST["categoryName"] ?? "値段未入力");

$stmt = $pdo->prepare('
    INSERT INTO `scategory` SET
    categoryId = :id,
    categoryName = :name
');
$stmt->bindValue(":name", $name, PDO::PARAM_STR);
$stmt->bindValue(":id", $id, PDO::PARAM_STR);
$stmt->execute();

header("Location: management.php");
exit();
?>