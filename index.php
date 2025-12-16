<?php
session_status();
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Online Store</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
    <div class="container">

        <div class="row vh-100 d-flex justify-content-center align-items-center">
            <!-- sign in box -->
            <div class="col-10 col-lg-4" id="signinBox">
                <div class="row card">
                    <div class="card-body">
                        <div class="col-12 text-center">
                            <h2>Sign In</h2>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="siEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="siEmail" value="<?php echo (isset($_COOKIE['email']) ? $_COOKIE['email'] : ''); ?>">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="siPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="siPassword" value="<?php echo (isset($_COOKIE['password']) ? $_COOKIE['password'] : ''); ?>">
                        </div>

                        <div class="errorMsgDiv1 d-none">
                            <div class="alert alert-danger" id="errorMsg1">
                                <!-- Error Message -->
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="row">

                                <div class="col-6 mb-3">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label for="rememberMe" class="form-check-label">remember me</label>
                                </div>

                                <div class="col-6 mb-3 text-end">
                                    <a href="pages/user/forgotPassword.php" class="text-decoration-none link-secondary">Forgot Password?</a>
                                </div>

                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button class="btn btn-secondary" id="signinBtn">Sign In</button>
                        </div>

                        <div class="text-center">
                            <a href="#" class="text-decoration-none link-secondary" id="togglesignin">New to Online Store</a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- sign in box -->
            <!-- sign up box -->
            <div class="col-10 col-lg-4 d-none" id="signupBox">
                <div class="row card">
                    <div class="card-body">
                        <div class="col-12 text-center">
                            <h2>Sign Up</h2>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="suFname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="suFname">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="suLname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="suLname">
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="suMobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control" id="suMobile">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="suEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="suEmail">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="suPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="suPassword">
                        </div>

                        <div class="errorMsgDiv2 d-none">
                            <div class="alert alert-danger" id="errorMsg2">
                                <!-- Error Message -->
                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button class="btn btn-secondary" id="signupBtn">Sign Up</button>
                        </div>

                        <div class="col-12 text-center">
                            <p>already have an account? <a class="text-decoration-none link-secondary" id="togglesignup">sing in</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sign up box -->

        </div>

    </div>

    <script src="assets/js/script.js"></script>
</body>

</html>