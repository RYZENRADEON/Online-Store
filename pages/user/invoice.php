<?php
session_start();
include '../../config/connection.php';

if (!isset($_SESSION["user"]) || !isset($_GET['orderHistoryId'])) {
    header("Location: ../../index.php");
    exit;
}

$addressRs = Database::search("SELECT * FROM `useraddress` WHERE `users_id` = '" . $_SESSION['user']['id'] . "'");
if ($addressRs->num_rows > 0) {
    $address = $addressRs->fetch_assoc();
}

$orderHistoryId = $_GET['orderHistoryId'];
$ohRs = Database::search("SELECT * FROM `order_history` WHERE `orderHistory_id` = '" . $_GET['orderHistoryId'] . "'");
if ($ohRs->num_rows > 0) {
    $row = $ohRs->fetch_assoc();
}

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

    <div class="container mt-2 mb-4">
        <div class="row d-flex justify-content-center">
            <div class="col-10 offset-1 text-end mt-2 mb-2">
                <button class="btn btn-danger" id="printBtn">Print</button>
            </div>
            <div class="col-10 offset-1 card bg-dark-subtle shadow-sm" id="printArea">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="fw-bold">INVOICE <span class="fs-4 text-muted"> #<?php echo ($row['order_id']); ?></span></h1>
                            <p><span class="fw-bold">DATE:</span> <?php echo ($row['order_date']); ?></p>
                        </div>

                        <div class="col-6">
                            <div class="fw-bold fs-5 mt-3">Online Store Pvt Ltd</div>
                            <div>No.221B,</div>
                            <div>Baker Street</div>
                            <div>UK</div>
                        </div>

                        <div class="col-6 text-end">
                            <div class="fw-bold fs-5 mt-3"><?php echo ($_SESSION['user']['fname'] . " " . $_SESSION['user']['lname']) ?></div>
                            <div><?php echo ($address['no']); ?>,</div>
                            <div><?php echo ($address['line_1']); ?></div>
                            <?php if (!isset($address['line_2']) || !empty($address['line_2'])) {
                            ?>
                                <div><?php echo ($address['line_2']); ?></div>
                            <?php
                            }
                            ?>
                            <div><?php echo ($address['city']); ?></div>
                            <div><?php echo ($address['postal_code']); ?></div>
                        </div>

                        <div class="col-12 mt-4">
                            <table class="table table-striped table-hover table-dark">
                                <thead>
                                    <tr>
                                        <th>PRODUNT NAME</th>
                                        <th>PRICE</th>
                                        <th>Qty</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $total = 0;
                                    $deliveryFee = 500;

                                    $orderItemRs = Database::search("SELECT `order_items`. `qty` AS `qty`, `order_items`.`price` AS `price`, `stock_details`.`product_name` AS `product_name` FROM `order_items` JOIN `stock_details` ON `order_items`.`stock_id` = `stock_details`.`stock_id` WHERE `order_items`.`orderHistory_id` = '$orderHistoryId'");
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
                        </div>

                        <div class="col-6">
                            <h3>Thank You...</h3>
                        </div>

                        <div class="col-6 text-end">
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

                        <div class="col-6 text-end"></div>
                    </div>
                </div>
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