<?php
include('config.php');

if($_POST['selesai'] == 'Iya'){

$urutan = $_POST['urutan'];
$sqlsimpan = "UPDATE daftar_cuci SET selesai = NOW(), status = 'Selesai' WHERE id = '$urutan'";
		  mysql_query($sqlsimpan) 
		  or die ("Gagal Mengeksekusi Perintah SQL". mysql_error());  
				  if ($sqlsimpan) {
					header('location:pembayaran.php');
						};
} else {	header('location:pembayaran.php');
						}					
						
?>