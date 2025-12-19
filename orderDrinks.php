<?php
require_once "pdo.php";

session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$tableNo = isset($_GET['tableNo']) ? (int) $_GET['tableNo'] : 1;

$sqlItem = "SELECT * FROM smenu WHERE category = 5 ORDER BY id ASC";
$stmtItem = $pdo->prepare($sqlItem);
$stmtItem->execute();
$items = $stmtItem->fetchAll(PDO::FETCH_ASSOC);

echo '<script src="script.js" defer></script>';

include "nav.php";
foreach ($items as $item) {
    $name = (string)$item['name'];
    $id = (int)$item["id"];
    $qty = $_SESSION['cart'][$id]['amount'] ?? 0;
    $filename = "images.jpg";
    echo '<section>';
    echo '<img src="./upfiles/' . $filename . '" alt="">';
    echo '<div>';
    echo '<h2>' . $item["name"] . '</h2>';
    echo '<p>' . $item["price"] . '</p>';
    echo '</div>';
    echo '<button type="button" class="minus" data-id="' . $id . '" data-name="' . htmlspecialchars($name) . '">➖️</button>';
    echo '<span class="qty">' . (int)$qty . '</span>';
    echo '<button type="button" class="plus"  data-id="' . $id . '" data-name="' . htmlspecialchars($name) . '">➕️</button>';   

    echo '</p>';
    echo '</section>';
}

?>