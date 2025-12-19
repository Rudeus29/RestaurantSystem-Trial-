<?php
session_start();
header('Content-Type: application/json; charset=UTF-8');

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

$id    = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
$name  = isset($_POST['name']) ? trim((string)$_POST['name']) : "";
$delta = isset($_POST['delta']) ? (int)$_POST['delta'] : 0;

if ($id <= 0 || $name === "" || ($delta !== 1 && $delta !== -1)) {
    echo json_encode(['ok' => false, 'message' => 'Invalid parameters']);
    exit;
}

$current = $_SESSION['cart'][$id]["amount"] ?? 0;
$newQty = $current + $delta;
if ($newQty < 0) $newQty = 0;

$_SESSION['cart'][$id] =[
    "id" => $id,
    "name"=>$name,
    "amount"=>$newQty
];

echo json_encode(['ok' => true, 'amount' => $newQty]);
exit;
?>
