<?php
include '../../config/connection.php';

$colorName = $_POST["colorName"];

if(empty($colorName)) {
    echo "Color name cannot be empty";
} else {
    $rs = Database::search("SELECT * FROM `color` WHERE `color_name` = '".$colorName."'");
    $num = $rs -> num_rows;
    if($num > 0) {
        echo "Color already exists";
    } else {
        Database::iud("INSERT INTO `color` (`color_name`) VALUES ('".$colorName."')");
        echo "success";
    }
}