<?php
require_once 'pdo.php';
session_start();
// テーブル番号取得 (デフォルト1)
$tableNo = isset($_SESSION['tableNo']) ? (int) $_SESSION['tableNo'] : 1;


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
<html>

<head>
    <title>HomePageSky</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
        .brand {
            background: #cbb09c !important;
        }

        .brand-text {
            color: #cbb09c !important;
        }

        form {
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }
    </style>
</head>

<body class="grey lighten-3">
    <nav class="white ">
        <div class="container">
        <a class="black-text left">Table <?php echo htmlspecialchars($tableNo); ?></a>
            <a href="#" class="brand-logo brand-text center">Sky Restaurant</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li><a href="orderSpecials.php" class="btn brand">Order Food</a></li>
            </ul>
        </div>
    </nav>