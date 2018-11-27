<?php
include 'config.php';
session_start();
$user = $_SESSION['session_user'];
$query = mysql_query("UPDATE datakasir SET lastlogout = NOW() WHERE nama = '$user' ");
$_SESSION['session_user'] = '';
unset($_SESSION['session_user']);
session_unset();
session_destroy();
header('location:login.php');


?>