<?php
session_start();
include '../../config/connection.php';

if (!isset($_SESSION["user"])) {
    header("Location: ../../index.php");
    exit;
}

$users_id = $_SESSION["user"]["id"];
$cartId   = $_GET['cartId'];
$status   = $_GET['status'] === 'true';

if (!isset($cartId) || empty($cartId)) {
    echo ('Invalid cart id');
}

$rs = Database::search("SELECT * FROM `cart` WHERE `cart_id` = '$cartId' AND `users_id` = '$users_id'");

if ($rs->num_rows === 1) {
    $row       = $rs->fetch_assoc();
    $qtyOfCart = (int)$row['qty'];
    $stock_id  = (int)$row['stock_id'];

    $rs1       = Database::search("SELECT * FROM `stock` WHERE `stock_id` = '$stock_id'");
    $row1      = $rs1->fetch_assoc();
    $qtyOfStock = (int)$row1['qty'];

    if ($status) { // increment
        if ($qtyOfCart < $qtyOfStock) {
            $qtyOfCart++;
            Database::iud("UPDATE `cart` SET `qty` = '$qtyOfCart' WHERE `cart_id` = '$cartId'");
            echo ('success');
        } else {
            echo "Not enough stock available.";
        }
    } else { // decrement
        if ($qtyOfCart > 1) {
            $qtyOfCart--;
            Database::iud("UPDATE `cart` SET `qty` = '$qtyOfCart' WHERE `cart_id` = '$cartId'");
            echo ('success');
        } else {
            echo "Quantity cannot be less than 1.";
        }
    }
} else {
    echo "Cart item not found. Please check.";
}
