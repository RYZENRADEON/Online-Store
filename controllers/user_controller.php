<?php
require_once '../models/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'register':

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = User::register($fname, $lname, $mobile, $email, $password);
            echo $result;
            break;

        case 'logIn':

            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = User::logIn($email, $password);
            echo $result;
            break;
        
        default:
            # code...
            break;
    }
} else {
    echo 'REQUEST_METHOD_NOT_MATCH';
}
