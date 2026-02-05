<?php
session_start();
include '../../config/connection.php';
if (!isset($_SESSION["user"])) {
    header("Location: ../../index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Online Store</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="icon" href="../../assets/images/logo/logo01.png">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
</head>

<body id="cart">
    <!-- header -->
    <?php include 'userHeader.php'; ?>
    <!-- header -->

    <div class="container" id="content">

        <!-- cart item -->

        <!-- cart item -->

    </div>

    <!-- Include the user footer -->
    <?php include 'userFooter.php'; ?>
    <!-- Include the user footer -->

    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/script.js"></script>
</body>

</html>