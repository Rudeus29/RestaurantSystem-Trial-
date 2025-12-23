<?php
require_once("pdo.php");
session_start();
print_r($_SESSION["cart"]);
$tableNo = isset($_GET['tableNo']) ? (int) $_GET['tableNo'] : 1;

$sqlTotal = "
    SELECT SUM(i.price * o.amount) as total
    FROM sManagement m
    JOIN sOrder o ON m.orderNo = o.orderNo
    JOIN sItem i ON o.itemNo = i.id
    WHERE m.tableNo = :tableNo AND m.state = 1
";
$stmtTotal = $pdo->prepare($sqlTotal);
$stmtTotal->bindValue(':tableNo', $tableNo, PDO::PARAM_INT);
$stmtTotal->execute();
$totalResult = $stmtTotal->fetch(PDO::FETCH_ASSOC);
$currentTotal = $totalResult['total'] ? $totalResult['total'] : 0;

?>
<!DOCTYPE html>
<html lang="ja">
    <?php include "header.php";?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>スマートオーダー - Table <?php echo htmlspecialchars($tableNo); ?></title>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
        <div class="container">
            <div
                style="text-align: center; font-size: 1.5em; font-weight: bold; margin-bottom: 20px; padding: 10px; background-color: #eee; border-radius: 5px;">
                テーブルNo. <?php echo htmlspecialchars($tableNo); ?>
            </div>
    
            <!-- Dev Link -->
            <div style="text-align: right; margin-bottom: 10px;">
                <a href="management.php" style="color: #3498db; text-decoration: none;">管理画面へ (Dev)</a>
            </div>
    </body>

</html>