<?php
include 'connection.php';

$password = $_POST["password"];
$confirmPassword = $_POST["confirmPassword"];
$vcode = $_POST["vcode"];

if (empty($password)) {
    echo ("Please enter your new password");
} else if (empty($confirmPassword) || $password != $confirmPassword) {
    echo ("Passwords do not match");
} else if (empty($vcode)) {
    echo ("Please resend a forgot password request.");
} else {
    $rs = Database::search("SELECT * FROM `users` WHERE `v_code` = '$vcode'");
    $num = $rs->num_rows;

    if ($num > 0) {
        $row = $rs->fetch_assoc();

        Database::iud("UPDATE `users` SET `password` = '$password', `v_code` = NULL WHERE `id` = '" . $row["id"] . "'");
        echo ("success");
    } else {
        echo ("User Not Found.");
    }
}
