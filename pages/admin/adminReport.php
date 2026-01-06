<?php
session_start();
if (isset($_SESSION["admin"])) {
?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Reports | Online Store</title>

        <link rel="icon" href="../../assets/images/logo/logo01.png">
        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    </head>

    <body>
        <!-- Include the admin header -->
        <?php include 'adminHeader.php'; ?>
        <!-- Include the admin header -->

        <div class="container">
            <div class="row vh-100 d-flex align-items-center">
                <div class="row">
                    <div class="col-4">
                        <a class="btn btn-outline-warning fw-bold w-100" href="userReport.php">User Report</a>
                    </div>
                    <div class="col-4">
                        <a class="btn btn-outline-warning fw-bold w-100" href="productReport.php">Product Report</a>
                    </div>
                    <div class="col-4">
                        <a class="btn btn-outline-warning fw-bold w-100" href="stockReport.php">Stock Report</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include the admin footer -->
        <?php include 'adminFooter.php'; ?>
        <!-- Include the admin footer -->

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