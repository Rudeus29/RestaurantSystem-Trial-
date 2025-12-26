<?php
require_once 'pdo.php';
session_start();

$tableNo = isset($_SESSION['tableNo']) ? (int) $_SESSION['tableNo'] : 1;

$sql = "
    SELECT m.*, SUM(i.price * o.amount) as totalAmount
    FROM sManagement m
    LEFT JOIN sOrder o ON m.orderNo = o.orderNo
    LEFT JOIN sitem i ON o.itemNo = i.id
    WHERE tableNo = :tableNo
    GROUP BY m.orderNo
    ORDER BY m.state ASC, m.dateB DESC
";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':tableNo', $tableNo, PDO::PARAM_STR);
$stmt->execute();
$stmtOrder = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!empty($stmtOrder)) {

    $orderNo = $stmtOrder[0]["orderNo"];
    $total = $stmtOrder[0]["totalAmount"];

    $sqlDetail = "
    SELECT o.*, i.name, i.price
    FROM sOrder o
    JOIN sItem i ON o.itemNo = i.id
    WHERE o.orderNo = :orderNo
";
    $stmtDetail = $pdo->prepare($sqlDetail);
    $stmtDetail->bindValue(':orderNo', $orderNo, PDO::PARAM_STR);
    $stmtDetail->execute();
    $orders = $stmtDetail->fetchAll(PDO::FETCH_ASSOC);

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
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css?v=<?= filemtime(__DIR__ . "/style.css") ?>">
</head>

<body class="grey lighten-3">
    <nav class="nav-header">
        <div class="nav-container">
            <div class="nav-center">
            <span class="logo">Smart Order</span>
            <span class="table-no">Table <?php echo htmlspecialchars($tableNo); ?></span>
            </div>
        </div>
    </nav>
    <h2>現在の注文</h2>
    <div class="container">
        <table class="order-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>商品名</th>
                    <th>値段</th>
                    <th>数量</th>
                </tr>
            </thead>
            <tbody>
    <?php
                if (empty($orders)) { ?>
                    <tr>
                        <td colspan="4" style="text-align:center; padding:16px;">現在の注文はありません</td>
                    </tr>
                <?php } else {
                    $x = 1;
                    foreach ($orders as $order) { ?>
                        <tr>
                            <td><?php echo $x; ?></td>
                            <td><?php echo htmlspecialchars($order["name"]) ?></td>
                            <td><?php echo number_format($order['price']) ?></td>
                            <td><?php echo (int) $order['amount'] ?></td>
                            <?php $x++; ?>
                        </tr>
                    <?php }
                } ?>
            </tbody>
        </table>
        </div>
    <a href="menu.php?categoryId=1" class="order">Order Food</a>
    <div class="footer-bar">
        <?php if (empty($orders)) { ?>
            現在の合計金額: ¥<?php echo number_format(0);
        } else { ?>
            現在の合計金額: ¥<?php echo number_format($currentTotal);
        } ?>

    </div>
</body>
</html>