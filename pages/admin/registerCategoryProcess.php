<?php
include  "../../config/connection.php";

$categoryName = $_POST["categoryName"];

if (empty($categoryName)) {
    echo "Category name cannot be empty";
    exit;
} else {
    $rs = Database::search("SELECT * FROM `category` WHERE `cat_name` = '" . $categoryName . "'");
    $num = $rs->num_rows;
    if ($num > 0) {
        echo "Category already exists";
        exit;
    } else {
        Database::iud("INSERT INTO `category` (`cat_name`) VALUES ('" . $categoryName . "')");
        echo "success";
    }
}