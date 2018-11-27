<!doctype html>
<?php
include 'config.php';
include 'pengaturan.php';

session_start();

function login(){ //ini untuk menampilkan popup login dulu
	echo"
			<div id='popup' style='visibility:visible;'>
				<div class='window'>
				<h3 style='font-size:14pt;'>Anda harus login dulu sebagai kasir</h3>				
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
		<link rel="stylesheet" href="reservasi.css" type="text/css"/>
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
				<?php
				
				$jumlahAntri = mysql_fetch_array(mysql_query("SELECT COUNT(id) as id FROM daftar_cuci WHERE status = 'proses'"));
				$jumlahAntri = $jumlahAntri['id'];
				
				
					if($jumlahAntri > 2){
						$waktuAntri = mysql_fetch_array(mysql_query("SELECT  SEC_TO_TIME( SUM( TIME_TO_SEC( `lamaAntri` ) ) ) AS timeSum  
																	FROM daftar_cuci WHERE status = 'proses'"));
						$waktuAntri = new dateTime($waktuAntri['timeSum']);											
						$waktuAntri->add(new DateInterval("PT{$waktucuci}M"));
						$waktuAntri = $waktuAntri->format('H:i');
						
					}else if($jumlahAntri < 2){
						$waktuAntri = 0;				
					}else if($jumlahAntri = 2){
						$waktuAntri = 15;
					}
					
				$jumlahAntri = mysql_num_rows(mysql_query("SELECT id FROM daftar_cuci WHERE status = 'proses'"));	
				?>
				
				
				
				<h1>Antrian</h1>
				<h2>Estimasi waktu antri berikutnya</h2><br>
				<p>Untuk reservasi silakan masukkan data<br> pada kolom berikut: </p>
				</div>
				<div id="notifikasi2">
				<h1><?php print_r($jumlahAntri);?> _</h1>
				<h2><?php echo $waktuAntri;?></h2>
				</div>
			<div id="form">
				
				<form method="POST">
					<div class="form">
					<label for="id"><h3>ID :</h3></label>
					<input type="text" class="form-id" name="id" required="yes"/>
					</div>
					<div class="form">
					<label for="nomor_kendaraan"><h3>Nomor Kendaraan :</h3></label>
					<input type="text" class="form-nopol" name="tnkb" required="yes"/>
					</div>
					<div class="form">
					<label for="tipe_kendaraan"><h3>Tipe Kendaraan :</h3></label>
					<input type="text" class="form-tipe" name="tipe" required="yes"/>
					</div>
					<div id="tombol-simpan">
					<input type="submit" name="submit" value="Cuci !" />
					</div>
				</form>
			
			</div>
			
				<?php
				
				if(isset($_POST['submit'])){
					$id = $_POST['id'];
					$tnkb = $_POST['tnkb'];
					$tipe = $_POST['tipe'];
					
					date_default_timezone_set('Asia/Jakarta');
					
					$date = date("Y-m-d G:i:s ");
					$member = array();
					
							$cekmember = mysql_query('SELECT id FROM pelanggan');
							while ($membership = mysql_fetch_array($cekmember)){
							$member[] = $membership;
							}
							$array_member = array_map('current', $member);							
		
							//cek apakah id yang diinputkan valid
							if (in_array($id, $array_member)){							 
									
									//tentukan estimasi lama antri, lama waktu cuci, dan waktu selesai
									//cek dulu daftar antri nya:
									
									$sql = mysql_query("SELECT * FROM daftar_cuci WHERE status = 'Proses'");
									$jumlahAntri = mysql_num_rows($sql);
									
									if($jumlahAntri<2){
									
									$selesai = new dateTime($date);
									$selesai->modify("+{$waktucuci} minutes");									
								
									$sqlcuci = ("INSERT INTO daftar_cuci SET 
												id_pelanggan = '$id', 
												tnkb = '$tnkb', 
												tipe_kendaraan = '$tipe', 
												masuk = '".$date."', 
												estimasiSelesai = '".$selesai->format("Y-m-d G:i:s")."', 
												status = 'Proses',
												kasir = '$user'");
									mysql_query ($sqlcuci) 
									or die ("Gagal Mengeksekusi Perintah SQL". mysql_error());
									
									}else{
									
										$masuk2 = new dateTime($date);
										
										//simpan dulu ke database
										$simpan = mysql_query("INSERT INTO daftar_cuci SET 
																id_pelanggan = '$id', 
																tnkb = '$tnkb', 
																tipe_kendaraan = '$tipe', 
																masuk = '$date', 
																status = 'Proses',
																kasir = '$user'");
										
												//ambil ID (auto increment) dari pelanggan ini dulu
												$data2 = mysql_fetch_array ( mysql_query ("SELECT id FROM daftar_cuci WHERE masuk = '$date'"));
										
												$id_ = $data2['id'];	
												$id_ = ($id_) - 2 ; 			//ambil ID dari dua antrian sebelumnya										
												
										
										//ambil data 'masuk' dari dua pelanggan sebelumnya
										$data3 = mysql_fetch_array ( mysql_query ("SELECT masuk FROM daftar_cuci WHERE id = '$id_'"));
											$masuk3 = new dateTime($data3['masuk']);
											$lamaAntri = new dateTime($data3['masuk']);
												$lamaAntri->modify("+{$waktucuci} minutes"); 	//(masuka + waktucuci) - masukb
												$lamaAntri = date_diff($lamaAntri, $masuk2);	//estimasi lama antri
															
										$waktuCuci = new dateTime($lamaAntri->format("%H%I%S")); //estimasi lama waktu cuci + lama waktu antri
										//date_add($waktuCuci, date_interval_create_from_date_string('$waktucuci Minutes'));	
										
										$waktuCuci->modify("+{$waktucuci} minutes");
								
										
										$selesaiCuci = new dateTime($masuk2->format("G:i:s"));
										
										//date_add($selesaiCuci, date_interval_create_from_date_string('$waktucuci minutes'));
										//$selesaiCuci->add($waktuCuci);		//estimasi waktu selesai cuci
										//$selesaiCuci = $selesaiCuci->modify("+{($waktuCuci->format('H i s')}) minutes");
										
										//$selesaiCuci_ = $selesaiCuci->format("G:i:s");
										//$interval = new DateInterval("PT{$waktucuci}M");
										$selesaiCuci->add(new DateInterval("PT{$waktucuci}M"));
										
										
										//simpan ke database
										$simpan2 = mysql_query(
										"UPDATE daftar_cuci
										SET lamaAntri = '".$lamaAntri->format('%H:%I:%S')."', 
										lamaCuci = '".$waktuCuci->format("H:i:s")."', 
										estimasiSelesai = '".$selesaiCuci->format("H:i:s")."'
										WHERE id = ".$data2['id']."
										");	
										
										/*print_r($lamaAntri->format('%H:%I:%S'));
										echo "<br>";
										echo $waktuCuci->format("H:i:s");
										echo "<br>";
										echo $selesaiCuci->format("H:i:s");
										*/	
										}
									
						//kondisi khusus untuk id NOL (pelanggan yang bukan member)		
									if ($id == 0){							
									echo "<div id='popup' style='visibility:visible;'>
													<div class='window'>
													<h3 style='font-size:20pt;'>Data berhasil disimpan!</h3>
													<a href='reservasi.php'><input type='submit' value='oke'></a>
													</div>
													</div>";
													
									} else{	
									
									//cek jumlah kunjungan pelanggan
									$lihat_kunjungan = mysql_query ("SELECT jumlah_kunjungan FROM pelanggan WHERE id = '$id' ") or die ("Gagal Mengeksekusi Perintah SQL". mysql_error());
									while ($kunjungan_a = mysql_fetch_array($lihat_kunjungan)) {
									$kunjungan_b = ($kunjungan_a[0]) + 1; 
									}
									
									//menambah jumlah kunjungan member
									$kunjungan = "UPDATE  pelanggan SET jumlah_kunjungan = '$kunjungan_b' WHERE id = '$id'";
									mysql_query ($kunjungan) or die ("Gagal Mengeksekusi Perintah SQL". mysql_error());
									
						//kondisi pertama	cek apakah pelanggan mendapat hadiah dan cuci gratis?
											if((in_array($kunjungan_b, $_gratis)) AND (in_array($kunjungan_b, $_hadiah))) {
											echo "<div id='popup' style='visibility:visible;'>
													<div class='window'>
													<div class='blink'><h3>Selamat!</h3></div>
													Pelanggan mendapat hadiah berupa '$hadiah2' dan Cuci Gratis!<br>
													<a href='reservasi.php'><input type='submit' value='oke'></a>
													</div>
													</div>";
											//jalankan perintah SQL
											$kunjungan = "UPDATE  daftar_cuci SET hadiah = 'cuci gratis', jenis_hadiah = '$hadiah2' WHERE masuk = '$date'";
											mysql_query ($kunjungan) or die ("Gagal Mengeksekusi Perintah SQL". mysql_error());
						
						//kondisi kedua		cek apakah pelanggan mendapat hadiah?
											}else if(in_array($kunjungan_b, $_hadiah)) {
											echo "<div id='popup' style='visibility:visible;'>
													<div class='window'>
													<div class='blink'><h3>Selamat!</h3></div>
													Pelanggan mendapat hadiah berupa '$hadiah2'<br>
													<a href='reservasi.php'><input type='submit' value='oke'></a>
													</div>
													</div>";
											//jalankan perintah SQL
											$kunjungan = "UPDATE  daftar_cuci SET hadiah = 'hadiah' , jenis_hadiah = '$hadiah2' WHERE masuk = '$date'";
											mysql_query ($kunjungan) or die ("Gagal Mengeksekusi Perintah SQL". mysql_error());
						
						//kondisi ketiga	cek apakah pelanggan mendapat cuci gratis?					
											}else if(in_array($kunjungan_b, $_gratis)) {
											echo "<div id='popup' style='visibility:visible;'>
													<div class='window'>
													<div class='blink'><h3>Selamat!</h3></div>
													Pelanggan mendapat Cuci Gratis!<br>
													<a href='reservasi.php'><input type='submit' value='oke'></a>
													</div>
													</div>";
											//jalankan perintah SQL
											$kunjungan = "UPDATE  daftar_cuci SET hadiah = 'cuci gratis' WHERE masuk = '$date'";
											mysql_query ($kunjungan) or die ("Gagal Mengeksekusi Perintah SQL". mysql_error());
											
						
						//kondisi keempat	pelanggan/member tidak mendapat promo atau cuci gratis
									}else {
									echo "<div id='popup' style='visibility:visible;'>
											<div class='window'>
											<h3>Data berhasil disimpan!</h3>
											<a href='reservasi.php'><input type='submit' value='oke'></a>
											</div>
											</div>";
									
									
									}
						}
					}else{
					echo "<div id='popup' style='visibility:visible;'>
											<div class='window'>
											<h3>ID tidak terdaftar</h3>
											Masukkan ID yang benar, atau
											gunakan ID '0' untuk pelanggan bukan member<br>
											<a href='reservasi.php'><input type='submit' value='oke'></a>
											</div>
											</div>";
					}
			
				}?>
		
		</div>
		<div id="footer">
		OJbikewash - developed by: Adhifirdaus		
		</div>
		
	</body>
<html>