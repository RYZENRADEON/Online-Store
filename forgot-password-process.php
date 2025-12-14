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
            $mail->Body    = '<table style="width: 100%; font-family: sans-serif;">
    <tbody></tbody>
    <tr>
        <td align="center">

            <table style="max-width: 600px;">
                <tr>
                    <td align="center">
                        <a href="#" style="font-weight: bold; color:black; font-size: 35px; text-decoration: none;">ONLINE STORE</a>
                        <hr>
                    </td>
                </tr>

                <tr>
                    <td>
                        <h1 style="font-size: 25px; font-weight: bold; line-height: 45px;">Reset Your Password</h1>
                        <p style="margin-bottom: 24px;">To reset your password, please click the link below:</p>
                        <div>
                            <a href="#" style="display: inline-block; background-color: blue; color: white; border-radius: 8px; padding: 10px 20px; text-decoration: none;"><span>Reset Password</span></a>
                        </div>
                        <p style="margin-top: 24px;">If you did\'t request this, please ignore this email.</p>
                    </td>
                </tr>

                <tr>
                    <td align="center">
                        <hr>
                        <p style="font-size: 14px; color: gray;">&copy; 2024 Online Store. All rights reserved.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </tbody>
</table>';

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
