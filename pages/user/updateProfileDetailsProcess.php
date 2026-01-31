<?php
include '../../config/connection.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user']['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mobile = $_POST['mobile'];
$addNo = $_POST['addNo'];
$addLine1 = $_POST['addLine1'];
$addLine2 = $_POST['addLine2'];
$addCity = $_POST['addCity'];
$addPCode = $_POST['addPCode'];

class Validate
{
    public static function validateUserDetails($fname, $lname, $mobile)
    {
        if (empty($fname)) {
            echo "First name cannot be empty";
            exit;
        }
        if (strlen($fname) > 20) {
            echo "First name too long";
            exit;
        }
        if (empty($lname)) {
            echo "Last name cannot be empty";
            exit;
        }
        if (strlen($lname) > 20) {
            echo "Last name too long";
            exit;
        }
        if (empty($mobile)) {
            echo "Mobile cannot be empty";
            exit;
        }
        if (strlen($mobile) != 10) {
            echo "Mobile must be 10 digits";
            exit;
        }
        if (!preg_match("/^07[01245678][0-9]{7}$/", $mobile)) {
            echo "Invalid mobile format";
            exit;
        }
        return true;
    }

    public static function validateBillingDetails($addNo, $addLine1, $addCity, $addPCode)
    {
        if (empty($addNo)) {
            echo "Address Number cannot be empty";
            exit;
        }
        if (empty($addLine1)) {
            echo "Address line 1 cannot be empty";
            exit;
        }
        if (empty($addCity)) {
            echo "City cannot be empty";
            exit;
        }
        if (empty($addPCode)) {
            echo "Postal code cannot be empty";
            exit;
        }
        return true;
    }
}

if (Validate::validateUserDetails($fname, $lname, $mobile)) {
    Database::iud("UPDATE `users` SET `fname`='$fname', `lname`='$lname', `mobile`='$mobile' WHERE `id`='$user_id'");
    if (
        (!empty($addNo)) ||
        (!empty($addLine1)) ||
        (!empty($addLine2)) ||
        (!empty($addCity)) ||
        (!empty($addPCode))
    ) {
        if (Validate::validateBillingDetails($addNo, $addLine1, $addCity, $addPCode)) {
            $rs1 = Database::search("SELECT * FROM `useraddress` WHERE `users_id`='$user_id'");
            if ($rs1->num_rows > 0) {
                Database::iud("UPDATE `useraddress` 
                SET `no`='$addNo', `line_1`='$addLine1', `line_2`='$addLine2', 
                    `city`='$addCity', `postal_code`='$addPCode' 
                WHERE `users_id`='$user_id'");
            } else {
                Database::iud("INSERT INTO `useraddress` 
                (`users_id`, `no`, `line_1`, `line_2`, `city`, `postal_code`) 
                VALUES ('$user_id', '$addNo', '$addLine1', '$addLine2', '$addCity', '$addPCode')");
            }
        }
    }

    echo "success";
}
