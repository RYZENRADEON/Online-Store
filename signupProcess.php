<?php
include "connection.php";

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$password = $_POST['password'];

if (empty($fname)) {
    echo ("Please enter your first name");
    exit;
} elseif (strlen($fname) > 20) {
    echo ("First name should not exceed 20 characters");
    exit;
} elseif (empty($lname)) {
    echo ("Please enter your last name");
    exit;
} elseif (strlen($lname) > 20) {
    echo ("Last name should not exceed 20 characters");
    exit;
} elseif (empty($mobile)) {
    echo ("Please enter your mobile number");
    exit;
} elseif (strlen($mobile) != 10) {
    echo ("Mobile number should not exceed 10 characters");
    exit;
} elseif (!preg_match("/^07[01245678][0-9]{7}$/", $mobile)) {
    echo ("Invalid mobile number format");
    exit;
} elseif (empty($email)) {
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
    $rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $email . "'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("An account with this email already exists");
        exit;
    } else {
        Database::iud("INSERT INTO `users` (`fname`, `lname`, `mobile`, `email`, `password`, `user_type_id`) VALUES ('$fname','$lname','$mobile','$email','$password', '2')");
        echo ("success");
    }
}
