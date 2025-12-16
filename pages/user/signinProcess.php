<?php
include "../../config/connection.php";

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
} elseif (strlen($password) < 3 || strlen($password) > 20) {
    echo ("Password should be between 3 and 20 characters long");
    exit;
} else {
    $rs = Database::search("SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
    $num = $rs->num_rows;
    if ($num == 1) {
        $user = $rs->fetch_assoc();
        if ($user["status_id"] == 1) {

            session_start();// session start
            $_SESSION["user"] = $user;

            if ($_POST['rememberMe'] == "true") {
                setcookie("email", $email, time() + (30 * 24 * 60 * 60), "/");
                setcookie("password", $password, time() + (30 * 24 * 60 * 60), "/");
            } else {
                setcookie("email", "", time() - 3600, "/");
                setcookie("password", "", time() - 3600, "/");
            }
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