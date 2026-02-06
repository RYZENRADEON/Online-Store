<?php
session_start();
include '../../config/connection.php';

if (!isset($_SESSION["user"])) {
    header("Location: ../../index.php");
    exit;
}

$users_id = $_SESSION["user"]["id"];
$error = [];

if (isset($_POST['payment']) && isset($_SESSION["user"])) {
    $payment = json_decode($_POST['payment'], true);
    $date = new DateTime();
    $tz = new DateTimeZone('Asia/Colombo');
    $date->setTimezone($tz);

    $time = $date->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `order_history` (`order_id`, `order_date`, `amount`, `users_id`) VALUES ('" . $payment['order_id'] . "', '" . $time . "' , '" . $payment['amount'] . "', '" . $users_id . "')");

    $orderHistoryId = Database::$connection->insert_id;

    $stockRs = Database::search("SELECT * FROM `stock` WHERE `stock_id` = '" . $payment['stock_id'] . "'");
    $stock = $stockRs->fetch_assoc();

    if ($stock['qty'] >= $payment['qty']) {
        Database::iud("INSERT INTO `order_items` (`qty`, `price`, `orderHistory_id`, `stock_id`) VALUES ('" . $payment['qty'] . "', '" . $stock['price'] . "','$orderHistoryId',  '" . $payment['stock_id'] . "')");

        $newQty = $stock['qty'] - $payment['qty'];
        Database::iud("UPDATE `stock` SET `qty` = '$newQty' WHERE `stock_id` = '" . $payment['stock_id'] . "'");
    } else {
        $error[0] = "Insufficient Quentity";
    }
}

$json = [];

if (empty($error)) {
    $json['status'] = 'success';
    $json['orderHistoryId'] = $orderHistoryId;
} else {
    $json['status'] = 'error';
    $json['error'] = $error[0];
}

echo json_encode($json);
