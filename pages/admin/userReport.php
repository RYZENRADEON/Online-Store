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
        <title>Admin User Report | Online Store</title>

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
                    <h1>USER REPORT</h1>
                </div>
                <div class="col-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>MOBILE</th>
                                <th>USER TYPE</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $rs = Database::search(
                                "SELECT 
                                `users`.`id` ,`users`.`fname`, `users`.`lname`, `users`.`mobile`, `users`.`email`, `status`.`status`, `user_type`.`name` AS `type`
                                 FROM `users` 
                                 JOIN `status` ON `users`.`status_id` = `status`.`id` 
                                 JOIN `user_type` ON `users`.`user_type_id` = `user_type`.`id` ORDER BY `id` ASC "
                            );

                            while ($row = $rs->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo ($row["id"]); ?></td>
                                    <td><?php echo ($row["fname"] . " " . $row["lname"]); ?></td>
                                    <td><?php echo ($row["email"]); ?></td>
                                    <td><?php echo ($row["mobile"]); ?></td>
                                    <td><?php echo ($row["status"]); ?></td>
                                    <td><?php echo ($row["type"]); ?></td>
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