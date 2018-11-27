<?php
include 'config.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysql_fetch_array(mysql_query("SELECT id FROM datakasir WHERE nama = '$username' AND password = '$password'"));

if($query != NULL){
		mysql_query("UPDATE datakasir SET lastlogin = NOW() WHERE nama = '$username'");
		$_SESSION['session_user'] = $username;
		header('location:reservasi.php');
}else if ($username == "kasir" && $password == "kasir"){
		$_SESSION['session_user'] = $username;
		header('location:reservasi.php');
}else if ($username == "admin" && $password == "admin"){
	$_SESSION['session_user'] = $username;
	header('location:laporan.php');
}else{	
	header('location:login.php?error');
}

?>