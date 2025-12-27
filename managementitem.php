<?php
require_once("pdo.php");

$sql = "SELECT * from sitem";
$sqlitem = $pdo->prepare($sql);
$sqlitem->execute();
$items = $sqlitem->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>
        メニュー編集
    </title>
    <link rel="stylesheet" href="./style.css?v=<?= filemtime(__DIR__ . "/style.css") ?>">
</head>

<body>
<a href="management.php" class="management">back</a>
<a href="additem.php" class="add-menu-btn">✙Add Menu</a>
<div class="container">
    <?php foreach ($items as $item) {
        $id = $item["id"];
        $filename = $item["name"] . ".jpg" ?>
        <div class="menu">
            <div class="menu-img">
                <img src="./upfiles/<?php echo htmlspecialchars($filename); ?>" alt="">
            </div>
            <div class="menu-content">
                <form class="menu-form" method="POST" action="updateitem.php" enctype="multipart/form-data">
                    <div class="field">
                        <div class="field-label">ID</div>
                        <div class="field-input"><?php echo $id; ?></div>
                        <input class="field-input" type="hidden" name="id" id="id(<?php echo $id; ?>)"
                            value="<?php echo $id; ?>">
                    </div>
                    <div class="field">
                        <label class="field-label" for="state(<?php echo $id; ?>)">State</label>
                        <input class="field-input" type="text" name="state" id="state(<?php echo $id; ?>)"
                            value="<?php echo htmlspecialchars($item['state']); ?>">
                    </div>
                    <div class="field">
                        <label class="field-label" for="category(<?php echo $id; ?>)">Category</label>
                        <input class="field-input" type="number" name="category" id="category(<?php echo $id; ?>)"
                            value="<?php echo (int) $item['category']; ?>">
                    </div>
                    <div class="field">
                        <label class="field-label" for="name(<?php echo $id; ?>)">Name</label>
                        <input class="field-input" type="text" name="name" id="name(<?php echo $id; ?>)"
                            value="<?php echo htmlspecialchars($item['name']); ?>">
                    </div>
                    <div class="field">
                        <label class="field-label" for="price(<?php echo $id; ?>)">Price</label>
                        <input class="field-input" type="number" name="price" id="price(<?php echo $id; ?>)"
                            value="<?php echo (int) $item['price']; ?>">
                    </div>
                    <button class="btn btn-update" type="submit">Update</button>
                </form>
                <form class="menu-delete" method="POST" action="deleteitem.php">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button class="btn btn-delete" type="submit"
                    onclick="return confirm('Delete this item?');">Delete</button>
            </form>
        </div>
        </div>
    <?php } ?>
        </div>
</body>

</html>