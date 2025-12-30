<?php
require_once("pdo.php");
session_start();
if (!isset($_SESSION["tableNo"])) {
    http_response_code(400);
    exit("table is null");
}

$tableNo = $_SESSION["tableNo"];
$orderNo = date('YmdHis') . '-' . mt_rand(1000, 9999);
$orders = $_SESSION["cart"];
$sqlOrder = "INSERT INTO sOrder (orderNo, itemNo, amount) VALUES (:orderNo, :itemNo, :amount)";
$stmtOrder = $pdo->prepare($sqlOrder);
date_default_timezone_set('Asia/Tokyo');
$dt = new DateTime();



$sqlCheck = "SELECT orderNo FROM sManagement WHERE tableNo = :tableNo AND state = 1 LIMIT 1";
$stmtCheck = $pdo->prepare($sqlCheck);
$stmtCheck->bindValue(':tableNo', $tableNo, PDO::PARAM_INT);
$stmtCheck->execute();
$existingOrder = $stmtCheck->fetch(PDO::FETCH_ASSOC);

if ($existingOrder) {

    $orderNo = $existingOrder['orderNo'];

    $sqlUpdate = "UPDATE sManagement SET dateB = CURRENT_TIMESTAMP WHERE orderNo = :orderNo";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->bindValue(':orderNo', $orderNo, PDO::PARAM_STR);
    $stmtUpdate->execute();

} else {
    $orderNo = date('YmdHis') . '-' . mt_rand(1000, 9999);

    $sqlMgmt = "INSERT INTO sManagement (orderNo, tableNo) VALUES (:orderNo, :tableNo)";
    $stmtMgmt = $pdo->prepare($sqlMgmt);
    $stmtMgmt->bindValue(':orderNo', $orderNo, PDO::PARAM_STR);
    $stmtMgmt->bindValue(':tableNo', $tableNo, PDO::PARAM_INT);
    $stmtMgmt->execute();
}


foreach($orders as $order){
    $key = $order["id"];
    if (!isset($order["amount"]) || (int) $order["amount"] <= 0) {
        continue;
    }
    $stmtOrder->bindValue(':orderNo', $orderNo, PDO::PARAM_STR);
    $stmtOrder->bindValue(':itemNo', $order["id"], PDO::PARAM_INT);
    $stmtOrder->bindValue(':amount', $order["amount"], PDO::PARAM_INT);
    $stmtOrder->execute();
}


$_SESSION["cart"] = [];
header("Location: index.php");
?>