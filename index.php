<?php
session_start();

if(isset($_SESSION['session_user'])){
	if($_SESSION['session_user'] == "kasir"){
	header('location:reservasi.php');
	}else if($_SESSION['session_user'] == "admin"){
	header('location:laporan.php');
	}else{
	header('location:login.php');
	}	
}else{
header('location:login.php');
}
?>