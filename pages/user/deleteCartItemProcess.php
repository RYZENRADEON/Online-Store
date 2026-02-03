<?php
session_start();
include '../../config/connection.php';
if (!isset($_SESSION["user"])) {
    header("Location: ../../index.php");
    exit;
}

$cartId = $_GET['cartId'];

if (empty($cartId) || !isset($cartId)) {
    echo ('Invalid request');
} else {
    $rs = Database::search("SELECT * FROM `cart` WHERE `cart_id` = '$cartId'");
    if ($rs->num_rows != 1) {
        echo ('Cart item not found');
    } else {
        Database::iud("DELETE FROM `cart` WHERE `cart_id` = '$cartId'");
        echo ('success');
    }
}