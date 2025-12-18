<?php
session_start();
if (isset($_SESSION["admin"])) {
?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Product Managment | Online Store</title>

        <link rel="icon" href="../../assets/images/logo/logo01.png">
        <link rel="stylesheet" href="../../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../../assets/css/style.css">
    </head>

    <body id="adminUserPage" data-page="1">
        <!-- Include the admin header -->
        <?php include 'adminHeader.php'; ?>
        <!-- Include the admin header -->

        <div class="container admin-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10 mt-3">
                    <h2 class="text-center">Product Managment</h2>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mb-2">
                            <button class="btn btn-primary mb-3">Register Product</button>
                        </div>
                        <div class="col-6 offset-3 d-flex justify-content-center mb-3">
                            <button class="btn btn-primary me-2">Add Brand</button>
                            <button class="btn btn-secondary me-2">Add Category</button>
                            <button class="btn btn-danger">Add Size</button>
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

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Launch demo modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
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