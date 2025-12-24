<?php
require_once 'pdo.php';

// POSTリクエストのみ許可
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: management.php');
    exit;
}

$orderNo = isset($_POST['orderNo']) ? $_POST['orderNo'] : '';

if ($orderNo) {
    try {
        // orderNoに基づき、stateを2 (会計済) に更新
        $sql = "UPDATE sManagement SET state = 2, dateB = CURRENT_TIMESTAMP WHERE orderNo = :orderNo";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':orderNo', $orderNo, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        // エラー時はログに残すなどの処理が望ましいが、今回は簡易的に戻る
    }
}

// 管理画面に戻る
header('Location: management.php');
exit;
