<?php
include '../../config/connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../includes/PHPMailer.php';
require '../../includes/SMTP.php';
require '../../includes/Exception.php';

$email = $_POST['email'];

if (empty($email)) {
    echo "Please enter your Email Address.";
    exit;
} else {
    $ra = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");
    $num = $ra->num_rows;

    if ($num > 0) {
        $row = $ra->fetch_assoc();
        $vcode = uniqid();

        Database::iud("UPDATE `users` SET `v_code` = '" . $vcode . "' WHERE `id` = '" . $row["id"] . "'");

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'r5rx5600ma@gmail.com';
            $mail->Password = 'vwus eikl ihqt sfeg';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('r5rx500ma@gmail.com', 'Ryzen Amd');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Reset Your Password';
            $mail->Body = '
            <table style="width: 100%; font-family: sans-serif;">
                <tbody>
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
                                        <a href="http://localhost/Online-Store/pages/user/resetPassword.php?code=' . $vcode . '" style="display: inline-block; background-color: blue; color: white; border-radius: 8px; padding: 10px 20px; text-decoration: none;"><span>Reset Password</span></a>
                                    </div>
                                    <p style="margin-top: 24px;">If you didn\'t request this, please ignore this email.</p>
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

            $mail->send();
            echo "sent";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
