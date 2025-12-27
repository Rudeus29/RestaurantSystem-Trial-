<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面 - 注文一覧</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <a href="management.php" class="management">管理画面</a>
    <h1>カテゴリー登録</h1>
    <div class="menu">
        <div class="menu-content">
            <form class="menu-form" method="POST" action="addcategorylogic.php" enctype="multipart/form-data">
                <div class="field">
                    <label class="field-label" for="state">State</label>
                    <input class="field-input" type="text" name="state" id="state">
                </div>
                <div class="field">
                    <label class="field-label" for="categoryId">categoryId</label>
                    <input class="field-input" type="number" name="categoryId" id="categoryId">
                </div>
                <div class="field">
                    <label class="field-label" for="categoryName">categoryName</label>
                    <input class="field-input" type="text" name="categoryName" id="categoryName">
                </div>
                <button class="btn btn-update" type="submit">add</button>
            </form>
        </div>
    </div>
</body>