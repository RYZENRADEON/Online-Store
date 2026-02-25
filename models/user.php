<?php
// require '../config/connection.php';
class User
{
    public static function register($fname, $lname, $mobile, $email, $password)
    {
        if (empty($fname)) {
            return ("Please enter your first name");
            exit;
        } elseif (strlen($fname) > 20) {
            return ("First name should not exceed 20 characters");
            exit;
        } elseif (empty($lname)) {
            return ("Please enter your last name");
            exit;
        } elseif (strlen($lname) > 20) {
            return ("Last name should not exceed 20 characters");
            exit;
        } elseif (empty($mobile)) {
            return ("Please enter your mobile number");
            exit;
        } elseif (strlen($mobile) != 10) {
            return ("Mobile number should not exceed 10 characters");
            exit;
        } elseif (!preg_match("/^07[01245678][0-9]{7}$/", $mobile)) {
            return ("Invalid mobile number format");
            exit;
        } elseif (empty($email)) {
            return ("Please enter your email address");
            exit;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ("Invalid email format");
            exit;
        } elseif (empty($password)) {
            return ("Please enter your password");
            exit;
        } elseif (strlen($password) < 3 || strlen($password) > 20) {
            return ("Password should be between 3 and 20 characters long");
            exit;
        } else {
            $rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $email . "'");
            $num = $rs->num_rows;

            if ($num > 0) {
                return ("An account with this email already exists");
                exit;
            } else {
                Database::iud("INSERT INTO `users` (`fname`, `lname`, `mobile`, `email`, `password`, `user_type_id`, `status_id`) VALUES ('$fname','$lname','$mobile','$email','$password', '2', '1')");
                return ("success");
            }
        }
    }

    public static function logIn($email, $password)
    {
        if (empty($email)) {
            return ("Please enter your email address");
            exit;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ("Invalid email format");
            exit;
        } elseif (empty($password)) {
            return ("Please enter your password");
            exit;
        } elseif (strlen($password) < 3 || strlen($password) > 20) {
            return ("Password should be between 3 and 20 characters long");
            exit;
        } else {
            $rs = Database::search("SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
            $num = $rs->num_rows;
            if ($num == 1) {
                $user = $rs->fetch_assoc();
                if ($user["status_id"] == 1) {

                    session_start(); // session start
                    $_SESSION["user"] = $user;

                    if ($_POST['rememberMe'] == "true") {
                        setcookie("email", $email, time() + (30 * 24 * 60 * 60), "/");
                        setcookie("password", $password, time() + (30 * 24 * 60 * 60), "/");
                    } else {
                        setcookie("email", "", time() - 3600, "/");
                        setcookie("password", "", time() - 3600, "/");
                    }
                    return ("success");
                } else {
                    return ("Your account has been disabled. Please contact support.");
                    exit;
                }
            } else {
                return ("Incorrect email or password");
                exit;
            }
        }
    }
}
