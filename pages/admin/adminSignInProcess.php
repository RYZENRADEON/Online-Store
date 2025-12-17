<?php
include '../../config/connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email)) {
    echo ("Please enter your email address");
    exit;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid email format");
    exit;
} elseif (empty($password)) {
    echo ("Please enter your password");
    exit;
} else {
    $rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "' AND `password` = '" . $password . "' AND `user_type_id` = '1'");
    $num = $rs->num_rows;
    if ($num > 0) {
        $admin = $rs->fetch_assoc();
        if ($admin["status_id"] == '1') {

            session_start();
            $_SESSION["admin"] = $admin;
            echo ("success");

        } else {
            echo ("Your account has been disabled. Please contact support.");
            exit;
        }
    } else {
        echo ("Incorrect email or password");
        exit;
    }
}
