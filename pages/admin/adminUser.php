<?php
session_start();
if (isset($_SESSION["admin"])) {
?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard | Online Store</title>

        <link rel="icon" href="../../assets/images/logo/logo01.png">
        <link rel="stylesheet" href="../../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../../assets/css/style.css">
    </head>

    <body id="adminUserPage">
        <!-- Include the admin header -->
        <?php include 'adminHeader.php'; ?>
        <!-- Include the admin header -->

        <div class="container admin-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <h2 class="text-center">User Managment</h2>
                    <div class="mt-4 table-responsive">
                        <table class="table table-striped">

                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th class="text-center">Action</th>
                                </tr>

                            </thead>

                            <tbody id="tableContent">

                                <!-- <tr>
                                    <th>00</th>
                                    <th>fname</th>
                                    <th>lname</th>
                                    <th>email@gmail.com</th>
                                    <th></th>
                                    <th><button class="btn btn-danger w-100">inactive</button></th>
                                </tr>
                                <tr>
                                    <th>00</th>
                                    <th>fname</th>
                                    <th>lname</th>
                                    <th>email@gmail.com</th>
                                    <th></th>
                                    <th><button class="btn btn-primary w-100">active</button></th>
                                </tr> -->

                            </tbody>
                        </table>
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