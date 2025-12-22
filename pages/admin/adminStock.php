<?php
include  "../../config/connection.php";

session_start();
if (isset($_SESSION["admin"])) {
?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Stock Managment | Online Store</title>

        <link rel="icon" href="../../assets/images/logo/logo01.png">
        <link rel="stylesheet" href="../../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../../assets/css/style.css">
    </head>

    <body id="adminStockPage" data-page="1">
        <!-- Include the admin header -->
        <?php include 'adminHeader.php'; ?>
        <!-- Include the admin header -->

        <div class="container admin-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10 mt-3">
                    <h2 class="text-center">Stock Managment</h2>
                    <div class="row">

                        <div class="col-12 d-flex justify-content-center mb-2">
                            <button class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#registerStockModal">Register Stock</button>
                        </div>

                        <div class="mt-4 table-responsive" id="content">
                            <!-- fetch product -->

                            <!-- fetch product -->
                        </div>

                    </div>
                </div>
            </div>

            <!-- Include the admin footer -->
            <?php include 'adminFooter.php'; ?>
            <!-- Include the admin footer -->

            <!-- Register Stock Modal -->
            <div class="modal fade" id="registerStockModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Register Stock</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="regStockPro" class="form-label">Select Product</label>
                                <select id="regStockPro" class="form-select">
                                    <option value="0">Select Product</option>
                                    <?php
                                    $rs = Database::search("SELECT * FROM `product_details` WHERE `status_id` = 1");
                                    $num = $rs->num_rows;

                                    for ($x = 0; $x < $num; $x++) {
                                        $row = $rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($row["product_id"]) ?>"><?php echo ($row["product_name"] . ' ' . $row["color_name"] . ' ' . $row["cat_name"] . ' ' . $row["size_name"] . ' ' . $row["brand_name"]); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label for="regStockPrice" class="form-label">Unit Price</label>
                                <input type="number" min="1" step="5.5" class="form-control" name="" id="regStockPrice">
                            </div>

                            <div class="mb-2">
                                <label for="regStockQty">Quantity</label>
                                <input type="number" min="1" step="1" class="form-control" name="" id="regStockQty">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="regStockBtn">Add Stock</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Register Stock Modal -->

            <script src="../../assets/js/script.js"></script>
            <script src="../../assets/js/bootstrap.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: adminSignIn.php");
    exit;
}
?>