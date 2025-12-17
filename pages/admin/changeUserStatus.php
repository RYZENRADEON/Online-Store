<?php
include "../../config/connection.php";

$userId = $_POST["userId"];
$newStatus = $_POST["newStatus"];
$status = ($newStatus == 1) ? "2" : "1";

$rs = Database::search("SELECT * FROM `users` WHERE `id` = '" . $userId . "' AND `status_id` = '" . $status . "'");
$num = $rs->num_rows;

if ($num != 1) {
    echo "User status change not allowed";
    exit;
} else {
    Database::iud("UPDATE `users` SET `status_id` = '" . $newStatus . "' WHERE `id` = '" . $userId . "'");
    echo "success";
}
