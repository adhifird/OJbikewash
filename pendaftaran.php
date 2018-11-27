<!doctype html>
<?php 

session_start();
include('config.php');

function login(){ //ini untuk menampilkan popup login dulu
	echo"
			<div id='popup' style='visibility:visible;'>
				<div class='window'>
				<h3>Anda harus login dulu sebagai kasir</h3>				
				<a href='index.php' ><input type='submit' style='margin-left:0px;' value='oke'></a>								
				</div>
			</div>
			";
	};

if(isset($_SESSION['session_user'])){
		
	$user = $_SESSION['session_user'];
	$cekUser = mysql_fetch_array(mysql_query("SELECT id FROM datakasir WHERE nama = '$user'"));
	
	if($cekUser != NULL){
	
	}else if($_SESSION['session_user'] == "kasir"){
	
	}else{
	login();
	}
	
}else{
login();
}
?>
<html>
	<head>
		<title>OJ bikewash</title>
		<link rel="icon" type="image/png" href="images/favicon.png"/>
		<link rel="stylesheet" href="pendaftaran.css" type="text/css"/>
	<head>
	<body>
			<div id="menu">			
				<a href="reservasi.php"><li>Reservasi</li></a>
				<a href="pembayaran.php"><li>Pembayaran</li></a>
				<a href="pendaftaran.php"><li>Pendaftaran Member</li></a>
				<a href="logout.php" id="logout" ><li>Logout</li></a>
			
			</div>
		<div id="halaman">
				<div id="logo">
				</div>
				<div id="notifikasi">
				<h1>Pendaftaran Member</h1>
				<p>Masukkan identitas pelanggan sesuai form yang tersedia<br> untuk mendaftar sebagai member: </p>
				</div>
			
				
				<form method="POST">
					<div class="form">
					<label for="nama">Nama :</label>
					<input type="text" name="nama" required="yes"/>
					</div>
					<div class="form">
					<label for="alamat">Alamat :</label>
					<input type="text" name="alamat" required="yes"/>
					</div>
					<div class="form">
					<label for="nomor-telepon">Nomor Telepon :</label>
					<input type="text" name="notelp" required="yes"/>
					</div>
					<div id="tombol-simpan">
					<input type="submit" name="daftarkan" value="Daftarkan" />
					</div>
				</form>
			
			<?php
				
				if(isset($_POST['daftarkan'])){
					$nama = $_POST['nama'];
					$alamat = $_POST['alamat'];
					$notelp = $_POST['notelp'];
					
							echo "<div id='popup' style='visibility:visible;'>
														<div class='window'>
														<h3>Data berhasil disimpan</h3>
														<a href='pendaftaran.php'><input type='submit' value='Oke'></a>	
														</div>
													</div>";
							 
							$sqlcuci = "INSERT INTO pelanggan SET nama = '$nama', alamat = '$alamat', no_telp = '$notelp'";
							mysql_query ($sqlcuci) or die ("Gagal Mengeksekusi Perintah SQL". mysql_error());
									
									
				}?>
			
				
		
		</div>
		<div id="footer">
		OJbikewash - developed by: Adhifirdaus		
		</div>
		
	</body>
<html>