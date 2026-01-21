<?php

use Dom\Text;

session_start();
include '../../config/connection.php';
if (isset($_SESSION["user"])) {

?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shop | Online Store</title>

        <link rel="icon" href="../../assets/images/logo/logo01.png">
        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    </head>

    <body id="adSearch" data-page='1'>
        <!-- Include the user header -->
        <?php include 'userHeader.php'; ?>
        <!-- Include the user header -->

        <div class="container-fluid">
            <form action="shop.php" method="GET" class="row">
                <div class="col-5 offset-2 mt-4">
                    <div class="form-floating">
                        <input type="search" class="form-control" name="search" id="search" placeholder="search..." value="<?php echo ($text = $_GET["search"] ?? null); ?>">
                        <label for="search">Search</label>
                    </div>
                </div>

                <div class="col-2 mt-4 d-grid">
                    <button class="btn btn-secondary bg-secondary-subtle" id="searchBtn"><i class="bi bi-search"></i>Search</button>
                </div>
            </form>

            <div class="row" id="content">

                <?php include 'filterForm.php'; ?>

                <div class="col-9">
                    <div class="row">
                        <?php
                        $rs = Database::search("SELECT * FROM `stock_details` WHERE `stock_status` = 'active' AND `status` = 'active' LIMIT 8");

                        while ($row = $rs->fetch_assoc()) {
                        ?>
                            <div class="col-12 col-md-4 col-lg-3 my-3">
                                <div class="card rounded-3">
                                    <a href="singleProductView.php?productId=<?php echo($row['stock_id']); ?>" class="link-light text-decoration-none">
                                        <img src="<?php echo ($row["img"]); ?>" class="card-img-top rounded-top-3" alt="..." height="215px">
                                        <div class="card-body">
                                            <h5 class="card-title fs-4"><?php echo ($row["product_name"]); ?></h5>
                                            <p class="card-text"><?php echo ($row["description"]); ?></p>
                                            <p class="card-text fs-3 fw-bold text-secondary-emphasis text-end"> LKR <?php echo ($row["price"]); ?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="mt-3 offset-3 col-9 d-flex justify-content-center">

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
<?php
} else {
    header('location:../../index.php');
    exit;
}
