<?php

use Dom\Text;

session_start();
include '../../config/connection.php';
if (isset($_SESSION["user"])) {
    $users_id = $_SESSION["user"]["id"];
    $rs = Database::search("SELECT * FROM `users` WHERE `id`='$users_id'");
    if ($rs->num_rows == 1) {
        $row = $rs->fetch_assoc();
    } else {
        header('location:../../index.php');
        exit;
    }
?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile | Online Store</title>

        <link rel="icon" href="../../assets/images/logo/logo01.png">
        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    </head>

    <body>
        <!-- Include the user header -->
        <?php include 'userHeader.php'; ?>
        <!-- Include the user header -->

        <div class="container">
            <div class="row vh-100 d-flex justify-content-center align-items-center">

                <div class="col-4 text-center">

                    <img src="<?php echo ($row['profile'] ?? "../../assets/images/profile/default.png"); ?>" alt="" height="200px" class="img-fluid">
                    <div class="my-3 text-start">
                        <label for="" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="profileImg">
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-secondary" id="profPicUploadBtn">Upload</button>
                    </div>
                </div>

                <div class="col-8">
                    <div class="row">
                        <div class="col-12">
                            <h4>Personal Details</h4>
                        </div>
                        <div class="col-6 mb-2">
                            <label for="" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname" value="<?php echo ($row['fname']); ?>">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" value="<?php echo ($row['lname']); ?>">
                        </div>
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Email</label>
                            <input type="text" class="form-control"  value="<?php echo ($row['email']); ?>">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="" class="form-label">Mobile</label>
                            <input type="text" class="form-control" id="mobile" value="<?php echo ($row['mobile']); ?>">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="" class="form-label">User Type</label>
                            <input type="text" class="form-control" value="<?php echo ($row['user_type_id'] == 2 ? 'USER' : 'ADMIN'); ?>" disabled>
                        </div>
                    </div>

                    <?php
                    $rs1 = Database::search("SELECT * FROM `useraddress` WHERE `users_id` = '$users_id'");
                    $row1;
                    if ($rs1->num_rows == 1) {
                        $row1 = $rs1->fetch_assoc();
                    }
                    ?>
                    <div class="row mt-5">
                        <div class="col-12">
                            <h4>Billing Details</h4>
                        </div>
                        <div class="col-3 mb-2">
                            <label for="" class="form-label">NO.</label>
                            <input type="text" class="form-control" id="addNo" value="<?php echo($row1['no']?? null); ?>">
                        </div>
                        <div class="col-9 mb-2">
                            <label for="" class="form-label">Address Line 01</label>
                            <input type="text" class="form-control" id="addLine1" value="<?php echo($row1['line_1']?? null); ?>">
                        </div>
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Address Line 02 (Optional)</label>
                            <input type="text" class="form-control" id="addLine2" value="<?php echo($row1['line_2']?? null); ?>">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="" class="form-label">City</label>
                            <input type="text" class="form-control" id="addCity" value="<?php echo($row1['city']?? null); ?>">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="addPCode" value="<?php echo($row1['postal_code']?? null); ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mt-4">
                            <button class="btn btn-warning w-100" id="updateProfileBtn">Update Profile</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Include the user footer -->
        <?php include 'userFooter.php'; ?>
        <!-- Include the user footer -->

        <script src="../../assets/js/bootstrap.js"></script>
        <script src="../../assets/js/script.js"></script>
    </body>

    </html>
<?php
} else {
    header('location:../../index.php');
    exit;
}
