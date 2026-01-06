<?php
session_start();
include '../../config/connection.php';

if (isset($_SESSION["admin"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Product Report | Online Store</title>

        <link rel="icon" href="../../assets/images/logo/logo01.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    </head>

    <body>
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 mt-5 d-flex justify-content-center gap-3">
                    <button class="btn btn-secondary" onclick="history.back();"><i class="bi bi-arrow-left"></i> BACK</button>
                    <button class="btn btn-primary" id="printBtn"><i class="bi bi-printer-fill"></i> PRINT</i></button>
                </div>
            </div>
        </div>

        <div class="container" id="printArea">
            <div class="row">
                <div class="col-12 mb-4 text-start mx-3">
                    <h1>PRODUCT REPORT</h1>
                </div>
                <div class="col-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PRODUCT</th>
                                <th>CATEGORY</th>
                                <th>SIZE</th>
                                <th>BRAND</th>
                                <th>COLOR</th>
                                <th>STATUS</th>
                                <th>IMAGE</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $rs = Database::search("SELECT * FROM `product_details` ORDER BY `product_id` ASC");

                            while ($row = $rs->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo ($row["product_id"]); ?></td>
                                    <td><?php echo ($row["product_name"]); ?></td>
                                    <td><?php echo ($row["cat_name"]); ?></td>
                                    <td><?php echo ($row["size_name"]); ?></td>
                                    <td><?php echo ($row["brand_name"]); ?></td>
                                    <td><?php echo ($row["color_name"]); ?></td>
                                    <td><?php echo ($row["status"]); ?></td>
                                    <td><img src="<?php echo($row["img"]); ?>" alt="" height="100" width="100"></IMG></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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