<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>
        商品追加
    </title>
    <link rel="stylesheet" href="./additem.css">
</head>

<body>
    <div class="form-container">
        <h1>商品登録</h1>
        <form action="addlogic.php" method="post" enctype="multipart/form-data">
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" maxlength="32" required>

            <label for="price">値段</label>
            <input type="number" name="price" id="price" required></textarea>

            <label for="category">カテゴリー</label>
            <input type="number" name="category" id="category" required>

            <label for="postFile">画像</label>
            <input type="file" name="postFile" id="postFile" accept=".jpg, image/jpeg" required>

            <button type="submit">add item</button>
        </form>
    </div>
    <div class="form-container">
        <h1>カテゴリー登録</h1>
        <form action="addlogic2.php" method="post" enctype="multipart/form-data">
            <label for="categoryId">カテゴリーid</label>
            <input type="number" name="categoryId" id="categoryId" required>
            <label for="categoryName">カテゴリー名前</label>
            <input type="text" name="categoryName" id="categoryName" required></textarea>

            <button type="submit">add category</button>
        </form>
    </div>
</body>

</html>