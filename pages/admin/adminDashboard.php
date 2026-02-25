<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: adminSignIn.php");
    exit;
}
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

<body id="adminDashboard">
    <!-- Include the admin header -->
    <?php include 'adminHeader.php'; ?>
    <!-- Include the admin header -->

    <div class="container admin-body">
        <div class="row">

            <div style="width: 100%; height: 500px;" class="card">
                <canvas id="chart1"></canvas>
            </div>

        </div>
    </div>

    <!-- Include the admin footer -->
    <?php include 'adminFooter.php'; ?>
    <!-- Include the admin footer -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../assets/js/script.js"></script>
    <!-- <script type="module" src="../../assets/js/dashboad.js"></script> -->
    <script type="module" src="../../assets/js/window_loder.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>
</body>

</html>