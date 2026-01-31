<?php
include '../../config/connection.php';
session_start();

if (isset($_SESSION['user'])) {
    if (isset($_FILES['profileImg']) && $_FILES['profileImg']['error'] === UPLOAD_ERR_OK) {
        // $img = $_FILES['profileImg'];
        $users_id = $_SESSION['user']['id'];
        $rs = Database::search("SELECT * FROM `users` where `id` = '$users_id'");
        if ($rs->num_rows == 1) {
            $row = $rs->fetch_assoc();

            if (isset($row['profile']) && !empty($row['profile'])) {
                unlink($row['profile']);
            }

            $newPath = "../../assets/images/profile/" . uniqid() . $_FILES["profileImg"]["name"];
            move_uploaded_file($_FILES["profileImg"]["tmp_name"], $newPath);
            Database::iud("UPDATE `users` SET `profile` = '$newPath' WHERE `id` = '$users_id'");
            echo "success";
        } else {
            echo ('user not found');
        }
    } else {
        echo ('Select a Proper Profile Image');
    }
} else {
    echo ('Please log in first');
    header('Location: index.php');
}
