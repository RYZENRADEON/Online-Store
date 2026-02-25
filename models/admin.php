<?php
// include '../config/connection.php';
class Admin
{
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
        } else {
            $rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "' AND `password` = '" . $password . "' AND `user_type_id` = '1'");
            $num = $rs->num_rows;
            if ($num > 0) {
                $admin = $rs->fetch_assoc();
                if ($admin["status_id"] == '1') {

                    session_start();
                    $_SESSION["admin"] = $admin;
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
