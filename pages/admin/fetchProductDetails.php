<?php
include '../../config/connection.php';

$pordId = $_GET["id"];

if (empty($pordId)) {
    echo ('Cannot find the selected product');
} else {
    $rs = Database::search("SELECT * FROM `product` WHERE `product_id` = '$pordId'");
    $num = $rs->num_rows;
    if ($num = 1) {
        $row = $rs->fetch_assoc();
        echo (json_encode($row));
    } else {
        echo ('Selected product is not exists');
    }
}