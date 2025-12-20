<?php
include "../../config/connection.php";

$productId = $_POST["productId"];
$newStatus = $_POST["newStatus"];
$status = ($newStatus == 1) ? "2" : "1";

$rs = Database::search("SELECT * FROM `product` WHERE `product_id` = '" . $productId . "' AND `status_id` = '" . $status . "'");
$num = $rs->num_rows;

if ($num != 1) {
    echo "User status change not allowed";
    exit;
} else {
    Database::iud("UPDATE `product` SET `status_id` = '" . $newStatus . "' WHERE `product_id` = '" . $productId . "'");
    echo "success";
}
