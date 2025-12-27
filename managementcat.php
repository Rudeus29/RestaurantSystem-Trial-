<?php
require_once("pdo.php");

$sql = "SELECT * from scategory";
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
    <a href="management.php" class="management">管理画面</a>
    <a href="addcategory.php" class="add-menu-btn">✙Add Category</a>
    <h2 class="center">カテゴリー覧</h2>
    <div class="container">
        <?php foreach ($items as $item) {
            $id = (int) $item["id"]; ?>
            <div class="menu">
                <form class="menu-form" method="POST" action="updatecat.php" enctype="multipart/form-data">
                    <div class="menu-content">
                        <div class="field">
                            <div class="field-label">ID</div>
                            <div class="field-input"><?php echo $id; ?></div>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                        </div>

                        <div class="field">
                            <label class="field-label" for="state-<?php echo $id; ?>">State</label>
                            <input class="field-input" type="text" name="state" id="state-<?php echo $id; ?>"
                                value="<?php echo htmlspecialchars($item['state'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>

                        <div class="field">
                            <label class="field-label" for="category-<?php echo $id; ?>">categoryId</label>
                            <input class="field-input" type="number" name="categoryId" id="category-<?php echo $id; ?>"
                                value="<?php echo (int) $item['categoryId']; ?>">
                        </div>

                        <div class="field">
                            <label class="field-label" for="name-<?php echo $id; ?>">categoryName</label>
                            <input class="field-input" type="text" name="categoryName" id="name-<?php echo $id; ?>"
                                value="<?php echo htmlspecialchars($item['categoryName'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <button class="btn btn-update" type="submit">Update</button>
                    </div>
                </form>
                <form class="menu-delete" method="POST" action="deletecat.php">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button class="btn btn-delete" type="submit"
                        onclick="return confirm('Delete this item?');">Delete</button>
                </form>
            </div>

        <?php } ?>
    </div>