<?php
require_once("pdo.php");

$name = trim($_POST["name"] ?? "商品名未入力");
$price = trim($_POST["price"] ?? "値段未入力");
$category = trim($_POST["category"] ?? "カテゴリー未入力");

if ($name === "" || $price === "" || $category === "") {
    exit("全ての項⽬を⼊⼒してください。");
}

if (!isset($_FILES["postFile"]) || $_FILES["postFile"]["error"] !== UPLOAD_ERR_OK) {
    exit("ファイルのアップロードに失敗しました。");
}

$fileTmp = $_FILES["postFile"]["tmp_name"];

$filetype = mime_content_type($fileTmp);

if ($filetype !== "image/jpeg") {
    exit("アップロードできるのはJPG画像のみです。");
}

$uploadDir = "upfiles/";

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

date_default_timezone_set('Asia/Tokyo');
$filename = $name . ".jpg";

$savePath = $uploadDir . $filename;

if (!move_uploaded_file($fileTmp, $savePath)) {
    exit("画像の保存に失敗しました。");
}

$stmt = $pdo->prepare('
    INSERT INTO `sitem` SET
    name = :name,
    price = :price,
    category = :category
');
$stmt->bindValue(":name", $name, PDO::PARAM_STR);
$stmt->bindValue(":price", $price, PDO::PARAM_STR);
$stmt->bindValue(":category", $category, PDO::PARAM_STR);

$stmt->execute();

header("Location: management.php");
exit();
?>