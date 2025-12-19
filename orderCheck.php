<!DOCTYPE html>
<html>
<h1>注文確認</h1>
<?php 
include "nav.php";
require_once("pdo.php");
session_start();

$orders = $_SESSION["cart"];
$ordername = array_keys($orders);

$x = 0;

?>
<table>
    <tr>
<th>name</th>
<th>quantity</th>
</tr>
<tr><?php foreach($orders as $order){?>
    <td><?php echo $order["name"]; ?></td>
    <td><?php echo $order["amount"] . "</br>"; ?></td>
    <?php $x+=1;?>
</tr>
<?php } ?>
</table>
<form method="POST" action="logic.php">
    <button type="submit" name="place_order" value="1">Order</button>
  </form>

</html>