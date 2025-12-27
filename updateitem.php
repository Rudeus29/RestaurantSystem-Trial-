<?php
require_once("pdo.php");

$id = trim($_POST["id"]);
$state = trim($_POST["state"]);
$category = trim($_POST["category"]);
$name = trim($_POST["name"]);
$price = trim($_POST["price"]);

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
    UPDATE `sitem` SET
    state = :state,
    category = :category,
    name = :name,
    price = :price
    WHERE id = :id;
');
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->bindValue(":state", $state, PDO::PARAM_INT);
$stmt->bindValue(":category", $category, PDO::PARAM_INT);
$stmt->bindValue(":name", $name, PDO::PARAM_STR);
$stmt->bindValue(":price", $price, PDO::PARAM_INT);

$stmt->execute();

header("Location: managementitem.php");
?>