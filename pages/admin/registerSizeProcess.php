<?php
include  "../../config/connection.php";

$sizeName = $_POST["sizeName"];

if (empty($sizeName)) {
    echo "Size name cannot be empty";
    exit;
} else {
    $rs = Database::search("SELECT * FROM `size` WHERE `size_name` = '" . $sizeName . "'");
    $num = $rs->num_rows;
    if ($num > 0) {
        echo "Size already exists";
        exit;
    } else {
        Database::iud("INSERT INTO `size` (`size_name`) VALUES ('" . $sizeName . "')");
        echo "success";
    }
}