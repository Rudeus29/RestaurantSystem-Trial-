<?php
require_once("pdo.php");

$id = trim($_POST["id"]);

$stmt = $pdo->prepare('
    DELETE FROM `sitem`
    WHERE id =:id;
');
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->execute();

header("Location: managementitem.php");

?>