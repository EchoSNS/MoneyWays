<?php
require_once("cpanel/config/db.php");
unset($_SESSION['loggedin']);
unset($_SESSION['user_id']);
$_SESSION['logout'] = "logout";
header("location: index.php");
?>