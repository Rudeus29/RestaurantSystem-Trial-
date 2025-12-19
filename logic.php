<?php
require_once("pdo.php");

session_start();
$orders = $_SESSION["cart"];
$sqlOrder = "INSERT INTO sOrder (orderNo, itemNo, amount) VALUES (:orderNo, :itemNo, :amount)";
$stmtOrder = $pdo->prepare($sqlOrder);
date_default_timezone_set('Asia/Tokyo');
$dt = new DateTime();
foreach($orders as $order){
    $stmtOrder->bindValue(':orderNo', $dt->format("YmdHis"), PDO::PARAM_STR);
    $stmtOrder->bindValue(':itemNo', $order["id"], PDO::PARAM_INT);
    $stmtOrder->bindValue(':amount', $order["amount"], PDO::PARAM_INT);
    $stmtOrder->execute();
}

?>