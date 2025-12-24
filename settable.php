<?php
session_start();

$tableNo = filter_input(INPUT_GET, 'tableNo', FILTER_VALIDATE_INT);
if (!$tableNo || $tableNo <= 0) {
    http_response_code(400);
    exit("Invalid tableNo");
}

$_SESSION['tableNo'] = $tableNo;


header("Location: index.php");
exit;
?>