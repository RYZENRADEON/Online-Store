<?php
session_start();
include '../../config/connection.php';

if (!isset($_SESSION["user"])) {
    header("Location: ../../index.php");
    exit;
}

$users_id = $_SESSION["user"]["id"];

$diliveryFee = 500.00;
$totalAmount = 0;
?>

<div class="row mb-5">

    <div class="col-12 my-4">
        <h2><i class="bi bi-cart4">Shopping Cart</i> </h2>
    </div>

    <div class="col-12">
        <div class="row">
            <?php
            $rs = Database::search("SELECT * FROM `cart` WHERE `users_id` = '$users_id'");
            $num = $rs->num_rows;

            if ($num > 0) {
                while ($row = $rs->fetch_assoc()) {
            ?>
                    <?php
                    $srock_id = $row['stock_id'];
                    $rs1 = Database::search("SELECT * FROM `stock_details` WHERE `stock_id` = '$srock_id'");
                    $row1 = $rs1->fetch_assoc();
                    ?>
                    <!-- cart item -->
                    <div class="col-12 border border-3 rounded-3 mb-2 d-flex align-items-center justify-content-between" data-cartid="<?php echo ($row['cart_id']); ?>">
                        <div class="d-flex">
                            <img class="rounded-4" src="<?php echo ($row1['img']); ?>" alt="" height="200">
                            <div class="ms-2">
                                <h4><?php echo ($row1['product_name']); ?></h4>
                                <p><?php echo ('Color : ' . $row1['color_name']); ?></p>
                                <p><?php echo ('Size : ' . $row1['size_name']); ?></p>
                                <h5 class="fw-bold text-primary-emphasis"><?php echo ('LKR. ' . $row1['price']); ?></h5>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-sm btn-light rounded-pill" onclick="cartQtyChange(<?php echo ($row['cart_id']); ?>, false)"> - </button>
                            <input type="number" class="form-control form-control-sm text-center" style="width: 100px;" min="1" max="<?php echo ($row1['qty']); ?>" value="<?php echo ($row['qty']); ?>" disabled>
                            <button class="btn btn-sm btn-light rounded-pill" onclick="cartQtyChange(<?php echo ($row['cart_id']); ?>, true)"> + </button>
                        </div>

                        <div class="d-flex align-items-center">
                            <h2 class="text-success-emphasis">LKR. <?php echo ($row['qty'] * $row1['price']); ?></h2>
                        </div>

                        <div>
                            <button class="btn btn-danger btn-sm rounded-pill" id="delCartBtn" onclick="removeFromCart(<?php echo ($row['cart_id']); ?>);"><i class="bi bi-trash3-fill"></i></button>
                        </div>

                    </div>
                    <!-- cart item -->
                <?php
                    $totalAmount += ($row['qty'] * $row1['price']) + $diliveryFee;
                }
                ?>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 text-end">
                    <h5>Number of Items <span class="text-warning fw-bold"><?php echo ($num); ?></span></h5>
                    <h4>Dilivery fee <span class="text-muted">LKR <?php echo ($diliveryFee); ?></span></h4>
                    <h3>Total Amount: <span class="text-success-emphasis">LKR. <?php echo ($totalAmount); ?></span></h3>

                    <button class="btn btn-success w-25 checkoutBtn" id="checkoutBtn">checkout</button>
                </div>

            <?php
            } else {
                ?>
                <div class="col-8 offset-2 text-center vh-75">
                    <img src="../../assets/images/default/empty_cart.png" class="img-fluid" alt="">
                    <h2 class="text-success-emphasis">no products</h2>
                    <span class="text-muted">let's do shopping and pick your choice</span>
                </div>
                <?PHP
            }
            ?>
        </div>
    </div>

</div>