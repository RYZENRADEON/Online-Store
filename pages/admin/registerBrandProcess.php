<?php
include  "../../config/connection.php";

$brandName = $_POST["brandName"];

if (empty($brandName)) {
    echo "Brand name cannot be empty";
    exit;
} else {
    $rs = Database::search("SELECT * FROM `brand` WHERE `name` = '" . $brandName . "'");
    $num = $rs->num_rows;
    if ($num > 0) {
        echo "Brand already exists";
        exit;
    } else {
        Database::iud("INSERT INTO `brand` (`name`) VALUES ('" . $brandName . "')");
        echo "success";
    }
}