<?php
require_once 'pdo.php';

// POSTリクエストのみ許可
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: management.php');
    exit;
}

try {
    // 外部キー制約がある場合を考慮して、念のためチェックを無効化してTruncateする
    // 今回の構成では単純なTRUNCATEで良いかもしれないが、安全策をとる
    $pdo->query("SET FOREIGN_KEY_CHECKS = 0");

    $pdo->query("TRUNCATE TABLE sOrder");
    $pdo->query("TRUNCATE TABLE sManagement");

    $pdo->query("SET FOREIGN_KEY_CHECKS = 1");

} catch (PDOException $e) {
    echo "エラーが発生しました: " . $e->getMessage();
    exit;
}

// 管理画面に戻る
header('Location: management.php');
exit;
