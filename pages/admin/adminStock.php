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

    <body id="adminProductPage" data-page="1">
        <!-- Include the admin header -->
        <?php include 'adminHeader.php'; ?>
        <!-- Include the admin header -->

        <div class="container admin-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10 mt-3">
                    <h2 class="text-center">Stock Managment</h2>
                    <div class="row">

                        <div class="col-12 d-flex justify-content-center mb-2">
                            <button class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#registerProductModal">Register Product</button>
                        </div>

                        <div class="col-6 offset-3 d-flex justify-content-center mb-3">
                            <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#registerBrandModal">Register New Brand</button>
                            <button class="btn btn-sm btn-secondary me-2" data-bs-toggle="modal" data-bs-target="#registerColorModal">Register New Color</button>
                            <button class="btn btn-sm btn-secondary me-2" data-bs-toggle="modal" data-bs-target="#registerCategoryModal">Register New Category</button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#registerSizeModal">Register New Size</button>
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