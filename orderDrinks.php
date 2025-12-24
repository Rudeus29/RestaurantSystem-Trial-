<?php
require_once "pdo.php";

session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$tableNo = isset($_GET['tableNo']) ? (int) $_GET['tableNo'] : 1;

$sqlItem = "SELECT * FROM sitem WHERE category = 5 ORDER BY id ASC";
$stmtItem = $pdo->prepare($sqlItem);
$stmtItem->execute();
$items = $stmtItem->fetchAll(PDO::FETCH_ASSOC);

echo '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./style.css?v=<?= filemtime(__DIR__ . "/style.css") ?>">
<script src="script.js" defer></script>
</head>
<body>';

include "nav.php";
foreach ($items as $item) {
    $name = (string)$item['name'];
    $id = (int)$item["id"];
    $qty = $_SESSION['cart'][$id]['amount'] ?? 0;
    $filename = $name . ".jpg";
    echo '<section>';
    echo '<img src="./upfiles/' . $filename . '" alt="">';
    echo '<div>';
    echo '<h3>' . $item["name"] . '</h3>';
    echo '<p>' . $item["price"] . '</p>';
    echo '</div>';
    echo '<button type="button" class="minus" data-id="' . $id . '" data-name="' . htmlspecialchars($name) . '">➖️</button>';
    echo '<span class="qty">' . (int)$qty . '</span>';
    echo '<button type="button" class="plus"  data-id="' . $id . '" data-name="' . htmlspecialchars($name) . '">➕️</button>';   

    echo '</section>';
}
echo '</body></html>';
?>