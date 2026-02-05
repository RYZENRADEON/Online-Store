<?php
session_start();
include '../../config/connection.php';

if (!isset($_SESSION["user"])) {
    header("Location: ../../index.php");
    exit;
}

$user = $_SESSION["user"];
$users_id   = $user["id"];
$userFName  = $user['fname'];
$userLName  = $user['lname'];
$userEmail  = $user['email'];
$userMobile = $user['mobile'];

$error = '';

$stockList = [];
$qtyList   = [];

if (isset($_GET['cart']) && $_GET['cart'] == 'true') {
    $rs = Database::search("SELECT * FROM `cart` WHERE `users_id` = '$users_id'");
    while ($row = $rs->fetch_assoc()) {
        $stockList[] = $row['stock_id'];
        $qtyList[]   = $row['qty'];
    }
}

$merchantId     = 1233906;
$merchantSecret = 'ODgwNDU1NTE2MzQwNTcxNDY2NzM0MjUxNzE4MjQzMjAwMzU2NzIx';

$items    = [];
$netTotal = 0;
$currency = 'LKR';
$orderId  = uniqid();

for ($x = 0; $x < sizeof($stockList); $x++) {
    $stockRs = Database::search("SELECT * FROM `stock_details` WHERE `stock_id` = '" . $stockList[$x] . "'");
    $stock   = $stockRs->fetch_assoc();

    $stockQty = $stock['qty'];

    if ($stockQty >= $qtyList[$x]) {
        $items[]   = $stock['product_name'];
        $netTotal += intval($stock['price']) * intval($qtyList[$x]);
    } else {
        $error = 'Insufficient Quantity';
    }
}

// Add fixed delivery fee
$netTotal += 500;

// Hash calculation
$hash = strtoupper(
    md5(
        $merchantId .
            $orderId .
            number_format($netTotal, 2, '.', '') .
            $currency .
            strtoupper(md5($merchantSecret))
    )
);

$payment = [];
$payment['sandbox']     = true;
$payment['merchant_id'] = $merchantId;
$payment['return_url']  = 'http://localhost/Online-Store';
$payment['cancel_url']  = 'http://localhost/Online-Store';
$payment['notify_url']  = 'http://localhost/Online-Store';
$payment['order_id']    = $orderId;
$payment['items']       = implode(". ", $items);
$payment['amount']      = number_format($netTotal, 2, '.', '');
$payment['currency']    = $currency;
$payment['hash']        = $hash;
$payment['first_name']  = $userFName;
$payment['last_name']   = $userLName;
$payment['email']       = $userEmail;
$payment['phone']       = $userMobile;

$addressRs = Database::search("SELECT * FROM `useraddress` WHERE `users_id` = '$users_id'");
$num       = $addressRs->num_rows;

if ($num > 0) {
    $address = $addressRs->fetch_assoc();

    $payment['address']          = $address['line_1'] . " " . $address['line_2'];
    $payment['city']             = $address['city'];
    $payment['country']          = 'Sri Lanka';
    $payment['delivery_address'] = $address['no'] . ", " . $address['line_1'] . ", " . $address['line_2'] . ", " . $address['city'] . ", " . $address['postal_code'];
} else {
    $error = 'noAddress';
}

$json = [];
if (empty($error)) {
    $json['status']  = 'success';
    $json['payment'] = $payment;
} else {
    $json['status'] = 'error';
    $json['error']  = $error;
}

echo json_encode($json);
