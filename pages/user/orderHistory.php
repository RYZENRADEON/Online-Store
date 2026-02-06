<?php
session_start();
include '../../config/connection.php';

if (!isset($_SESSION["user"])) {
    header("Location: ../../index.php");
    exit;
}

$users_id = $_SESSION["user"]["id"];
$orderHistoryRs = Database::search("SELECT * FROM `order_history` WHERE `users_id` = '$users_id'");
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | Online Store</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="icon" href="../../assets/images/logo/logo01.png">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
</head>

<body>

    <!-- header -->
    <?php include 'userHeader.php'; ?>
    <!-- header -->

    <div class="container">
        <div class="row">

            <div class="col-12 my-3">
                <h1>ORDER HISTORY</h1>
            </div>

            <div class="col-12">
                <?php
                if ($orderHistoryRs->num_rows > 0) {
                    while ($orderHistory = $orderHistoryRs->fetch_assoc()) {
                ?>

                        <div class="row pb-2">

                            <div class="card">
                                <div class="card-body">

                                    <h3>Order <span class="text-muted fs-5">#<?php echo ($orderHistory['order_id']); ?></span></h3>
                                    <p class="fw-bold">DATE <span class="text-muted fs-6"><?php echo ($orderHistory['order_date']); ?></span></p>

                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                                <th>PRODUCT NAME</th>
                                                <th>PRICE</th>
                                                <th>Qty</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $total = 0;
                                            $deliveryFee = 500;

                                            $orderItemRs = Database::search("SELECT `order_items`. `qty` AS `qty`, `order_items`.`price` AS `price`, `stock_details`.`product_name` AS `product_name` FROM `order_items` JOIN `stock_details` ON `order_items`.`stock_id` = `stock_details`.`stock_id` WHERE `orderHistory_id` = '" . $orderHistory['orderHistory_id'] . "'");
                                            if ($orderItemRs->num_rows > 0) {
                                                while ($orderItem = $orderItemRs->fetch_assoc()) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo ($orderItem['product_name']); ?></td>
                                                        <td>LKR. <?php echo ($orderItem['price']); ?></td>
                                                        <td><?php echo ($orderItem['qty']); ?></td>
                                                        <td>LKR. <?php echo ($orderItem['qty'] * $orderItem['price']); ?></td>
                                                    </tr>
                                            <?php
                                                    $total += $orderItem['qty'] * $orderItem['price'];
                                                }
                                            }
                                            ?>

                                        </tbody>
                                    </table>

                                    <div class="text-end">
                                        <div>
                                            <span class="fw-bold fs-5">Sub Total:</span>
                                            <span> LKR. <?php echo ($total); ?></span>
                                        </div>

                                        <div>
                                            <span class="fw-bold fs-5">Delivery Fee:</span>
                                            <span>LKR. <?php echo ($deliveryFee); ?></span>
                                        </div>

                                        <div>
                                            <span class="fw-bold fs-4">NET TOTAL:</span>
                                            <span class="fs-4">LKR. <?php echo ($total + $deliveryFee); ?></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php
                    }
                } else {
                    ?>
                    <div class="col-8 offset-2 text-center vh-75 mb-5">
                        <img src="../../assets/images/default/empty_cart.png" class="img-fluid" alt="">
                        <h2 class="text-success-emphasis">no order histories</h2>
                        <span class="text-muted">let's do shopping and pick your choice</span>
                    </div>
                <?PHP
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Include the user footer -->
    <?php include 'userFooter.php'; ?>
    <!-- Include the user footer -->

    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/script.js"></script>
</body>

</html>