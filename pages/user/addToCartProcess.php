<?php
include '../../config/connection.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user']['id'];
$stock = $_GET['stock'];
$qty = $_GET['qty'];

if (empty($stock)) {
    echo ('invalid stock');
} elseif ($qty < 1) {
    echo ('invaid quentity');
} else {
    $rs1 = Database::search("SELECT * FROM `stock` WHERE `stock_id` = '$stock'");
    if ($rs1->num_rows != 1) {
        echo ('The product cannot find on the stock.');
        exit;
    }

    $row1 = $rs1->fetch_assoc();


    $rs = Database::search("SELECT * FROM `cart` WHERE `users_id` = '$user_id' AND `stock_id` = '$stock'");
    if ($rs->num_rows > 0) {
        $row = $rs->fetch_assoc();
        $cartId = $row['cart_id'];

        $newQty = $row['qty'] + $qty;

        if ($newQty > $row1['qty']) {
            echo ('Quentity exceeded. Check your cart');
            exit;
        } else {
            Database::search("UPDATE `cart` SET `qty` = '$newQty' WHERE `cart_id` = '$cartId'");
        }
    } else {
        if ($qty > $row1['qty']) {
            echo ('Quentity exceeded');
            exit;
        } else {
            Database::iud("INSERT INTO `cart`(`users_id`,`stock_id`,`qty`) VALUES ('$user_id', '$stock', '$qty')");
        }
    }
    echo ('success');
}