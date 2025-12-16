<?php
session_start();

echo 'user email :' . $_SESSION["user"]["email"] . "  user password :" . $_SESSION["user"]["password"];