<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
<a href="management.php" class="management">管理画面</a>
<h1>商品登録</h1>
    <div class="menu">
        <div class="menu-content">
            <form class="menu-form" method="POST" action="managementlogic.php" enctype="multipart/form-data">
            <div class="menu-img-add">
            <label for="postFile">画像</label>
            <input type="file" name="postFile" id="postFile" accept=".jpg, image/jpeg" required>
            </div>
                <div class="field">
                    <label class="field-label" for="state">State</label>
                    <input class="field-input" type="text" name="state" id="state">
                </div>
                <div class="field">
                    <label class="field-label" for="category">Category</label>
                    <input class="field-input" type="number" name="category" id="category">
                </div>
                <div class="field">
                    <label class="field-label" for="name">Name</label>
                    <input class="field-input" type="text" name="name" id="name">
                </div>
                <div class="field">
                    <label class="field-label" for="price">Price</label>
                    <input class="field-input" type="number" name="price" id="price">
                </div>
                <button class="btn btn-update" type="submit">add</button>
            </form>
        </div>
    </div>
</body>