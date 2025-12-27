<?php
require_once("pdo.php");

$id = trim($_POST["id"]);
$state = trim($_POST["state"]);
$categoryId = trim($_POST["categoryId"]);
$categoryName = trim($_POST["categoryName"]);

$stmt = $pdo->prepare('
    UPDATE `scategory` SET
    state = :state,
    categoryId = :categoryId,
    categoryName = :categoryName
    WHERE id = :id;
');
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->bindValue(":state", $state, PDO::PARAM_INT);
$stmt->bindValue(":categoryId", $categoryId, PDO::PARAM_INT);
$stmt->bindValue(":categoryName", $categoryName, PDO::PARAM_STR);

$stmt->execute();

header("Location: managementcat.php");