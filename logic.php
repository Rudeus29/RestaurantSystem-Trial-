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


// 1. 既存の有効な注文(state=1)がこのテーブルにあるか確認
$sqlCheck = "SELECT orderNo FROM sManagement WHERE tableNo = :tableNo AND state = 1 LIMIT 1";
$stmtCheck = $pdo->prepare($sqlCheck);
$stmtCheck->bindValue(':tableNo', $tableNo, PDO::PARAM_INT);
$stmtCheck->execute();
$existingOrder = $stmtCheck->fetch(PDO::FETCH_ASSOC);

if ($existingOrder) {
    // 既存の注文がある場合、そのorderNoを使用
    $orderNo = $existingOrder['orderNo'];

    // dateB (最終更新日時) を更新
    $sqlUpdate = "UPDATE sManagement SET dateB = CURRENT_TIMESTAMP WHERE orderNo = :orderNo";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->bindValue(':orderNo', $orderNo, PDO::PARAM_STR);
    $stmtUpdate->execute();

} else {
    // 新規注文の場合、orderNoを生成してsManagementにINSERT
    $orderNo = date('YmdHis') . '-' . mt_rand(1000, 9999);

    $sqlMgmt = "INSERT INTO sManagement (orderNo, tableNo) VALUES (:orderNo, :tableNo)";
    $stmtMgmt = $pdo->prepare($sqlMgmt);
    $stmtMgmt->bindValue(':orderNo', $orderNo, PDO::PARAM_STR);
    $stmtMgmt->bindValue(':tableNo', $tableNo, PDO::PARAM_INT);
    $stmtMgmt->execute();
}


foreach($orders as $order){
    $stmtOrder->bindValue(':orderNo', $orderNo, PDO::PARAM_STR);
    $stmtOrder->bindValue(':itemNo', $order["id"], PDO::PARAM_INT);
    $stmtOrder->bindValue(':amount', $order["amount"], PDO::PARAM_INT);
    $stmtOrder->execute();
}


$_SESSION["cart"] = [];
header("Location: index.php");
?>