<?php
require_once("pdo.php");
$sqlCategory = "SELECT * FROM sCategory WHERE state = 1 ORDER BY categoryId ASC";
$stmtCategory = $pdo->prepare($sqlCategory);
$stmtCategory->execute();
$categories = $stmtCategory->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./style.css">
<ul>
    <li><a href="index.php">Home</a></li>
<?php
foreach ($categories as $category) { ?>
    <li><a href="menu.php?categoryId=<?= $category['categoryId'] ?>"><?php echo $category['categoryName']; ?></a>
    </li>
<?php } ?>
?>
    <li><a href="orderCheck.php">Order</a></li>
    <li><a href="management.php">Management</a></li>
</ul>

</html>