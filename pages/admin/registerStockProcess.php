<?php
include '../../config/connection.php';

$productId = $_POST["regStockPro"];
$price = $_POST["regStockPrice"];
$qty = $_POST["regStockQty"];

if (empty($productId) || $productId == '0') {
    echo ("Product cannot be empty");
} elseif (empty($price)) {
    echo ("Stock price cannot be empty");
} elseif (empty($qty)) {
    echo ("Stock quentity cannot be empty");
} elseif ($price <= 0 || !is_numeric($price)) {
    echo ('Invalid unit price');
} elseif ($qty <= 0 || !is_numeric($qty)) {
    echo ('Invalid stock quentity');
} else {
    $rs = Database::search("SELECT * FROM stock WHERE `price` = '$price' AND `product_id` = '$productId'");
    $num = $rs -> num_rows;

    if($num > 0) {
        $row = $rs -> fetch_assoc();
        $newQty = $row["qty"] + $qty;

        Database::iud("UPDATE `stock` SET `qty` = '$newQty' WHERE `stock_id` =  '".$row["stock_id"]."'");
    } else {
        // echo ($productId . " " . $price . " " . $qty);
        Database::iud("INSERT INTO `stock`(`price`,`qty`,`product_id`) VALUES ('$price','$qty','$productId')");
    }

    echo ("success");
}
