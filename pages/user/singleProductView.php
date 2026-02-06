<?php

use Dom\Text;

session_start();
include '../../config/connection.php';

if (!isset($_SESSION["user"])) {
    header('location:../../index.php');
    exit;
}
if (!isset($_GET['productId']) || empty($_GET['productId'])) {
    header('Location: home.php');
    exit;
}

$stockId = $_GET['productId'];

$rs = Database::search("SELECT * FROM `stock_details` WHERE `stock_id` = '$stockId' AND `product_status_id` = 1 AND `status_id` = 1");

if ($rs->num_rows < 1) {
    header('Location: home.php');
    exit;
}

$row = $rs->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($row['product_name']); ?> | Online Store</title>

    <link rel="icon" href="../../assets/images/logo/logo01.png">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
</head>

<body data-stock-id="<?php echo ($_GET['productId']); ?>">
    <!-- Include the user header -->
    <?php include 'userHeader.php'; ?>
    <!-- Include the user header -->

    <div class="row vh-100 d-flex align-items-center m-0">
        <div class="col-10 offset-1">
            <div class="card shadow bg-dark-subtle rounded-3">
                <div class="card-body d-flex">
                    <div>
                        <img src="<?php echo ($row['img']); ?>" alt="" class="rounded-3" height="350">
                    </div>

                    <div class="ms-5 w-100">
                        <h2 class="fw-bold text-warning mb-1"><?php echo ($row['product_name']); ?></h2>
                        <p class="text-muted"><?php echo ($row['description']); ?></p>

                        <ul class="list-unstyled">
                            <li class="mb-2"><?php echo ($row['cat_name']); ?></li>
                            <li class="mb-2"><?php echo ($row['brand_name']); ?></li>
                            <li class="mb-2"><?php echo ($row['color_name']); ?></li>
                            <li class="mb-2"><?php echo ($row['size_name']); ?></li>
                        </ul>

                        <h2 class="fw-bold text-primary-emphasis">LKR. <?php echo ($row['price']); ?></h2>

                        <div class="d-flex align-items-center">
                            <?php if ($row['qty'] > 0) {
                            ?>
                                <input type="number" min=1 max=<?php echo ($row['qty']); ?> value='1' id="cartQty" class="form-control" placeholder="Qty" style="width: 100px;">
                                <span class="ms-3 fw-bold text-bg-info rounded px-2 py-1"><?php echo ($row['qty']) ?> Quentity available.</span>
                            <?php
                            } else {
                            ?>
                                <span class="ms-3 fw-bold text-bg-danger rounded px-2 py-1"> out of stock</span>
                            <?php
                            }; ?>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6 d-grid">
                                <button class="btn btn-primary" id="addToCatrBtn">Add to Cart</button>
                            </div>
                            <div class="col-6 d-grid">
                                <button class="btn btn-secondary" id="buyNowBtn">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include the user footer -->
    <?php include 'userFooter.php'; ?>
    <!-- Include the user footer -->

    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/script.js"></script>
</body>

</html>
<?php
