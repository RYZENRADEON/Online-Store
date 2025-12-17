<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Online Store</title>

    <link rel="icon" href="../../assets/images/logo/logo01.png">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
</head>

<body>

    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center">
            <div class="col-10 col-lg-4">
                <div class="row card">
                    <div class="card-body">

                        <div class="col-12">
                            <H2 class="text-center">Reset Password</H2>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword">
                        </div>

                        <div class="d-none">
                            <input id="vcode" type="hidden" value="<?php echo ($_GET["code"]); ?>">
                        </div>

                        <div class="d-grid mb-3">
                            <button class="btn btn-secondary" id="resetPasswordBtn">Reset Password</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/script.js"></script>

</body>

</html>