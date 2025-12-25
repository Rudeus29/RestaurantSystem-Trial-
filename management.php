<?php
require_once 'pdo.php';

$sql = "
    SELECT m.*, SUM(i.price * o.amount) as totalAmount
    FROM sManagement m
    LEFT JOIN sOrder o ON m.orderNo = o.orderNo
    LEFT JOIN sitem i ON o.itemNo = i.id
    GROUP BY m.orderNo
    ORDER BY m.state ASC, m.dateB DESC
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面 - 注文一覧</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

<div class="container">
    <h1>注文管理一覧</h1>
    
    <div style="margin-bottom: 20px; padding: 10px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px;">
        <strong>お客様テーブルに置ける表示:</strong>
        <?php for($i=1; $i<=5; $i++): ?>
                    <a href="settable.php?tableNo=<?php echo $i; ?>" class="btn"
                    style="margin: 0 5px; padding: 5px 10px; font-size: 0.9em;">Table <?php echo $i; ?></a>
        <?php endfor; ?>
        
        <div style="margin-top: 15px; border-top: 1px dashed #ccc; padding-top: 10px;">
            <form action="reset_db.php" method="POST" onsubmit="return confirm('sOrderテーブル、sManagementテーブルをTRUNCATEしてリセットします。本当によろしいですか？');" style="display: inline;">
                <button type="submit" class="btn btn-red" style="font-size: 0.9em; padding: 5px 10px;">初期状態にリセット</button>
            </form>
        <a href="managementitem.php" class="btn brand">
        <button class="btn btn-blue" style="font-size: 0.9em; padding: 5px 10px;" >商品を追加する</button>
        </a>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>注文日時▲▼</th>
                <th>テーブル▲▼</th>
                <th>注文番号▲▼</th>
                <th>状態▲▼</th>
                <th>金額▲▼</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $week = ['日', '月', '火', '水', '木', '金', '土'];
            foreach ($orders as $order): 
                $ts = strtotime($order['dateB']);
                $dateStr = date('Y年m月d日', $ts) . '（' . $week[date('w', $ts)] . '）<br>' . date('H時i分s秒', $ts);
            ?>
            <tr>
                <td><?php echo $dateStr; ?></td>
                <td style="text-align: center; font-size: 1.2em;"><?php echo htmlspecialchars($order['tableNo']); ?></td>
                <td><?php echo str_replace('-', '<br>-', htmlspecialchars($order['orderNo'])); ?></td>
                <td>
                    <?php if ($order['state'] == 1): ?>
                        <span class="status-eating">食事中</span>
                    <?php elseif ($order['state'] == 2): ?>
                        <span class="status-paid">会計済</span>
                    <?php else: ?>
                        <span class="status-unknown">不明</span>
                    <?php endif; ?>
                </td>
                <td style="text-align: right;">¥<?php echo number_format($order['totalAmount']); ?></td>
                <td style="text-align: center;">
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <?php if ($order['state'] == 1): ?>
                            <form action="checkout.php" method="POST" onsubmit="return confirm('Table <?php echo $order['tableNo']; ?> を会計済にしますか？');" style="margin: 0;">
                                <input type="hidden" name="orderNo" value="<?php echo htmlspecialchars($order['orderNo']); ?>">
                                <button type="submit" class="btn btn-red" style="width: 100%; box-sizing: border-box;">会計済にする</button>
                            </form>
                        <?php endif; ?>
                        
                        <a href="order.php?orderNo=<?php echo urlencode($order['orderNo']); ?>" class="btn" style="width: 100%; box-sizing: border-box; text-align: center;">詳細を見る</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
