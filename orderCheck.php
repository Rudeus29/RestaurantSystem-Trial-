<!DOCTYPE html>
<html>
<h1>注文確認</h1>
<script src="./script.js?v=<?= filemtime(__DIR__ . '/script.js') ?>" defer></script>
<link rel="stylesheet" href="./style.css?v=<?= filemtime(__DIR__ . "/style.css") ?>">

<?php 
include "nav.php";
require_once("pdo.php");
session_start();
$orders = $_SESSION["cart"] ?? [];

foreach ($orders as $order) {
    $key = $order["id"];
    if (!isset($order["amount"]) || (int) $order["amount"] <= 0) {
        unset($orders[$key]);
    }
}

$ordername = array_keys($orders);

?>
<table>
<tr>
<th>name</th>
<th>quantity</th>
</tr>
<tr>
    <?php foreach ($orders as $order) {
        $name = (string) $order['name'];
        $id = (int) $order["id"];
        $qty = $_SESSION['cart'][$id]['amount'] ?? 0;
        $key = $order["id"];
        if (!isset($order["amount"]) || (int) $order["amount"] <= 0) {
            continue;
        } ?>
    <td><?php echo $order["name"]; ?></td>
    <td>
    <button type="button" class="minus" data-id="<?= $id ?>"
            data-name="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>">➖️</button>
        <span class="qty"><?= (int) $qty ?></span>
        <button type="button" class="plus" data-id="<?= $id ?>"
            data-name="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>">➕️</button>
    </td>
</tr>
<?php } ?>
</table>
<form method="POST" action="logic.php" class="orderfloat">
    <button type="submit" name="place_order" value="1">Order</button>
  </form>

</html>