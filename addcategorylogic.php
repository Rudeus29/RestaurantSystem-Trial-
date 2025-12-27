<?php
require_once("pdo.php");

$state = trim($_POST["state"] ?? "状態未入力");
$categoryId = trim($_POST["categoryId"] ?? "ID未入力");
$categoryName = trim($_POST["categoryName"] ?? "カテゴリー名未入力");

$stmt = $pdo->prepare('
    INSERT INTO `scategory` SET
    state = :state,
    categoryId = :categoryId,
    categoryName = :categoryName
');
$stmt->bindValue(":state", $state, PDO::PARAM_STR);
$stmt->bindValue(":categoryId", $categoryId, PDO::PARAM_STR);
$stmt->bindValue(":categoryName", $categoryName, PDO::PARAM_STR);

$stmt->execute();

header("Location: management.php");