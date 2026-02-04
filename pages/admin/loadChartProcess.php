<?php
session_start();
include '../../config/connection.php';

if (!isset($_SESSION["user"])) {
    header("Location: ../../index.php");
    exit;
}

$rs = Database::search("SELECT * FROM `stock_details`");
while($row = $rs -> fetch_assoc()){
    $labels[] = $row["product_name"];
    $data[] = $row["qty"];
}

$json = [];
$json['data'] = $data;
$json['labels'] = $labels;

echo json_encode($json); 