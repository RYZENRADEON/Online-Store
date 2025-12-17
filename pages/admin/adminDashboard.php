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
        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    </head>

    <body>
        <!-- Include the admin header -->
        <?php include 'adminHeader.php'; ?>
        <!-- Include the admin header -->


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