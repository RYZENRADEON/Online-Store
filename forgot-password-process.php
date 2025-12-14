<?php

require("connection.php");

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST["email"];

if (empty($email)) {
    echo ("Please enter your Email Address.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Not a valid Email Address.");
} else {
    $rs = DataBase::search("SELECT * FROM `users` WHERE `email` = '$email'");
    $num = $rs->num_rows;
    if ($num == 1) {
        $row = $rs->fetch_assoc();

        if ($row["status_id"] == 1) {

            $code = uniqid();
            DataBase::iud("UPDATE `users` SET `v_code` = '$code' WHERE `email` = '$email'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'r5rx5600ma@gmail.com';
            $mail->Password = 'pxwl ervg qchh giyg';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('r5rx5600ma@gmail.com', 'Reset Password');
            $mail->addReplyTo('r5rx5600ma@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'ONLINE STORE VERIFICATION CODE';
            $bodyContent = '************************** ' . $code . ' **************************';
            $bodyContent .= '******************';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo ("sent");
            }
        } else {
            echo ("Account is not active.");
        }
    } else {
        echo ("Email not found.");
    }
}
