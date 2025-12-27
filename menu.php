<?php
require_once "pdo.php";

session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$tableNo = isset($_GET['tableNo']) ? (int) $_GET['tableNo'] : 1;
$categoryId = $_GET['categoryId'];

$sqlItem = "SELECT * FROM sitem WHERE category = :categoryId ORDER BY id ASC";
$stmtItem = $pdo->prepare($sqlItem);
$stmtItem->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
$stmtItem->execute();
$items = $stmtItem->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./style.css?v=<?= filemtime(__DIR__ . '/style.css') ?>">
<script src="./script.js" defer></script>
</head>
<body>

<?php
include "nav.php";
?>
<main class="menu-grid">
<?php foreach ($items as $item) {
    $name = (string) $item['name'];
    $id = (int) $item["id"];
    $qty = $_SESSION['cart'][$id]['amount'] ?? 0;
    $filename = $name . ".jpg";
?>
    <section class="menu-card">
        <img class="menu-photo" src="./upfiles/<?= htmlspecialchars($filename, ENT_QUOTES, 'UTF-8') ?>" alt="">
    <div>
        <h3><?= htmlspecialchars($item["name"], ENT_QUOTES, 'UTF-8') ?></h3>
        <p><?= (int) $item["price"] ?></p>
    </div>
    <button type="button" class="minus" data-id="<?= $id ?>"
        data-name="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>">➖️</button>
    <span class="qty"><?= (int) $qty ?></span>
    <button type="button" class="plus" data-id="<?= $id ?>"
        data-name="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>">➕️</button>
</section>
<?php } ?>
</main>
<a href="ordercheck.php" class="order-check">カート</a>
</body>

</html>