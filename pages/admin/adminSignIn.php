<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sigh In | Online Store</title>

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
    <!-- ADMIN SIGN IN BOX -->
    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center">
            <div class="col-10 col-lg-4">
                <div class="row card">
                    <div class="card-body">

                        <div class="col-12 text-center">
                            <h2>Admin Sign In</h2>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="adSiEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="adSiEmail">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="adSiPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="adSiPassword">
                        </div>

                        <div class="errorMsgDiv3 d-none">
                            <div class="alert alert-danger" id="errorMsg3">
                                <!-- Error Message -->
                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button class="btn btn-secondary" id="adSigninBtn">Sign In</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ADMIN SIGN IN BOX -->

    <script src="assets/js/script.js"></script>
</body>

</html>