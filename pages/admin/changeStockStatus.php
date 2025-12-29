<?php
include "../../config/connection.php";

$stockId = $_POST["stockId"];
$newStatus = $_POST["newStatus"];
$status = ($newStatus == 1) ? "2" : "1";

$rs = Database::search("SELECT * FROM `stock` WHERE `stock_id` = '" . $stockId . "' AND `status_id` = '" . $status . "'");
$num = $rs->num_rows;

if ($num != 1) {
    echo "User status change not allowed";
    exit;
} else {
    Database::iud("UPDATE `stock` SET `status_id` = '" . $newStatus . "' WHERE `stock_id` = '" . $stockId . "'");
    echo "success";
}
