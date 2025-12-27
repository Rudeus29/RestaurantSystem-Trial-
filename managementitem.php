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
<a href="management.php" class="management">管理画面</a>
<a href="additem.php" class="add-menu-btn">✙Add Menu</a>
<h2 class="center">メニュー一覧</h2>
<div class="container">
<?php foreach ($items as $item): ?>
    <?php
    $id = (int) $item["id"];
    $filename = $item["name"] . ".jpg";
    $webPath = "./upfiles/" . $filename;
    $diskPath = __DIR__ . "/upfiles/" . $filename;
    $ver = file_exists($diskPath) ? filemtime($diskPath) : time();
    ?>

<div class="menu">
        <form class="menu-form" method="POST" action="updateitem.php" enctype="multipart/form-data">

            <div class="menu-img editable-img">
            <img src="<?php echo htmlspecialchars($webPath); ?>?v=<?php echo $ver; ?>" alt="">
                <label class="img-overlay" for="postFile-<?php echo $id; ?>">Choose file</label>
                <input type="file" name="postFile" id="postFile-<?php echo $id; ?>" class="file-input"
                    accept=".jpg, image/jpeg">
            </div>

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
                    <label class="field-label" for="category-<?php echo $id; ?>">Category</label>
                    <input class="field-input" type="number" name="category" id="category-<?php echo $id; ?>"
                        value="<?php echo (int) $item['category']; ?>">
                    </div>

                <div class="field">
                    <label class="field-label" for="name-<?php echo $id; ?>">Name</label>
                    <input class="field-input" type="text" name="name" id="name-<?php echo $id; ?>"
                        value="<?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>

                <div class="field">
                    <label class="field-label" for="price-<?php echo $id; ?>">Price</label>
                    <input class="field-input" type="number" name="price" id="price-<?php echo $id; ?>"
                        value="<?php echo (int) $item['price']; ?>">
                    </div>

                <button class="btn btn-update" type="submit">Update</button>
            </div>
        </form>

        <form class="menu-delete" method="POST" action="deleteitem.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button class="btn btn-delete" type="submit" onclick="return confirm('Delete this item?');">Delete</button>
            </form>

    </div>
<?php endforeach; ?>
</div>
</body>
</html>