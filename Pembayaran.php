<!doctype html>
<?php 

ob_start();
include "config.php";

session_start();

function login(){ //ini untuk menampilkan popup login dulu
	echo"
			<div id='popup' style='visibility:visible;'>
				<div class='window'>
				<h3>Anda harus login dulu sebagai kasir</h3>				
				<a href='index.php' ><input type='submit' style='position:initial;float:none;' value='oke'></a>								
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
		<link rel="stylesheet" href="pembayaran.css" type="text/css"/>
		
		<?php 		 
		if (!empty($_GET['message']) && $_GET['message'] == 'error1') {
			echo"
			<div id='popup' style='visibility:visible;'>
				<div class='window'>
				<h3>Harap masukkan jumlah uang sesuai biaya cuci atau yang lebih besar</h3>
				<a href='pembayaran.php' style='position:relative;left:60px;'><input type='submit' value='Oke'></a>								
				</div>
			</div>
			";
		}
		?>
		
		
		
		
	</head>
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
				<p>Untuk konfirmasi pembayaran, pilih pelanggan yang bersangkutan<br> pada daftar kemudian klik bayar.</p>
				<div id="biaya_cuci">
					<h3>Biaya cuci motor : Rp.6000,-</h3>
					</div>
				</div>
			
			<div id="daftar-cuci">
					
					<table cellpadding=5 cellspacing=0 width=830>
					<tr>
					<td width=20 style="border-right:1px solid black;">No</td>
					<td width=30 style="padding-left:15px;">ID</td>
					<td width=150>Nama</td>
					<td width=120>Nomor Kendaraan</td>
					<td width=120>Tipe Kendaraan</td>
					<td>Masuk</td>
					<td>Selesai</td>
					<td width=20>Status</td>
					<td ></td>
					</tr>
					
					
					
					<?php
					
					$daftar_cuci = mysql_query ("SELECT * 
												FROM daftar_cuci 
												JOIN pelanggan 
												ON pelanggan.id = daftar_cuci.id_pelanggan 
												
												ORDER BY masuk
												");
						$td_daftar = $daftar_cuci;
						
							if ($td_daftar !=0){
									$no = 1;
									
									while ($tabel = mysql_fetch_array($daftar_cuci) ){	

									$status = $tabel['status'];
									if ( $status == 'Selesai') {
									$warna="#51B11B";} else {$warna = "";};;
								
									$jam_masuk = substr(($tabel['masuk']),10, -3);
									$jam_selesai = substr(($tabel['selesai']),10, -3);
									?>
									
								<form method="POST" name="daftarcucian">										
							
									<tr class="daftar" style="background-color:<?php echo $warna; ?>;">
									<td style="border-right:1px solid black;"><?php echo $no; ?></td>
									<td style="font-weight:bold; padding-left:15px;"><?php echo $tabel['id_pelanggan'];?></td>
									<td style="font-weight:bold;"><?php echo $tabel['nama'];?></td>
									<td><?php echo $tabel['tnkb'];?></td>
									<td><?php echo $tabel['tipe_kendaraan'];?></td>
									<td><?php echo $jam_masuk;?></td>
									<td><?php echo $jam_selesai;?></td>
									<td><?php echo $tabel['status'];?></td>
									
									<td style="padding-left:15px;">
									
									<input id='<?php echo $no;?>' type='radio' name='urutan' value='<?php echo $tabel[0].','.$tabel['nama'].','.$tabel['hadiah'];?>' />
									<label for='<?php echo $no;?>'>>></label>
									</td>
									
									
								<?php
								$no++;};
							} else { 
							echo "";
							};
							
							
							?>
							
						</tr>
					</table>
						
			</div>
				
			<div id="form">	
					<div id="tombol-simpan">
					
						<input type="submit" name="btn_selesai" value="Selesai " />
						<input type="submit" name="btn_bayar" value="Bayar " />
					
					</div>			
			</div>
			</form>
			
			<?php 
			
			
					// jika button selesai diklik
				  if(isset($_POST['btn_selesai'])){
					
							if(empty($_POST['urutan'])){
							$urutan = 0;}
							else {
							
							$daftar = explode(",", $_POST['urutan']);
							$urutan = $daftar[0];
							$nama = $daftar[1];
								
								
							};

							// konfirmasi
							if(empty($urutan)){
							  echo "<div id='popup' style='visibility:visible;'>
										<div class='window'>
										<h3>Daftar belum dipilih</h3>
										<a href='pembayaran.php' style='position:relative;left:60px;'><input type='submit' value='Oke'></a>								
										</div>
									</div>";
							}else { 
							
							$cekSelesai = mysql_fetch_array( mysql_query("SELECT status, selesai FROM daftar_cuci WHERE id = $urutan"));
							
							
								if(($cekSelesai['status']) == "Selesai"){
								echo "<div id='popup' style='visibility:visible;'>
										<div class='window'>
										<h3>Motor nya $nama telah selesai dicuci
										pada jam".substr(($cekSelesai['selesai']),10,-3)."</h3>
										<a href='pembayaran.php' style='position:relative;left:60px;'><input type='submit' value='Oke'></a>								
										</div>
									</div>";
								
								}else{
								  echo "<div id='popup' style='visibility:visible;'>
											<div class='window'>
											<h3>Apakah motor '$nama' sudah selesai dicuci?</h3>
											<form method='POST' name='konfirmselesai' action='selesai.php'>
											<input type='hidden' name='urutan' value='$urutan'>
											<input type='submit' name='selesai' value='Iya'>								
											<a href='pembayaran.php'><input type='submit' value='Tidak'></a>								
											</form>
											</div>
										</div>";
							  
							}
							
						}
					//jika button bayar diklik
				  } else if (isset($_POST['btn_bayar'])) {
				  
							  if(empty($_POST['urutan'])){
								$urutan = 0;}
								else {
								$daftar = explode(",", $_POST['urutan']);
								$urutan = $daftar[0];
								$nama = $daftar[1];
								$hadiah = $daftar[2];
								
								};
							  
							  //konfirmasi popup
							if(empty($urutan)){
						  
							  echo "
									<div id='popup' style='visibility:visible;'>
										<div class='window'>
										<h3>Daftar belum dipilih</h3>
										<a href='pembayaran.php' style='position:relative;left:60px;'><input type='submit' value='Oke'></a>								
										</div>
									</div>
							  ";
							}else if($hadiah == "cuci gratis"){ //jika pelanggan mendapat cuci gratis
							
							$sqlbayar = "UPDATE daftar_cuci SET status = 'OK' WHERE id = '$urutan'";
							mysql_query ($sqlbayar) or die ("Gagal Mengeksekusi Perintah SQL". mysql_error());
							echo"
									<div id='popup' style='visibility:visible;'>
										<div class='window'>
										<h3>Pelanggan $nama mendapat cuci gratis</h3>
										<p>Jadi nggak usah bayar..</p>
										<a href='pembayaran.php' style='position:relative;left:60px;'><input type='submit' value='Oke'></a>								
										</div>
									</div>
							  ";
							
							}else { 
						  
							  echo "<div id='popup' style='visibility:visible;'>
										<div class='window'>
										<h3>Apakah pelanggan '$nama'<br> akan membayar?</h3>
										<form method='POST' name='formulirpopup' action='bayar.php'>
										<input type='hidden' name='urutan' value='$urutan'>
										Jumlah uang:
										<input style='margin-top:10px;' type='text' name='jumlah_uang' required='yes'><br>
										<input type='submit' name='ok_bayar' value='Bayar'>								
										
										</form>
										<a href='pembayaran.php'><input type='submit' value='Gak Jadi'></a>								
										</div>
									</div>";	
							}
				  }
				?>
		</div>
		<div id="footer">
		OJbikewash - developed by: Adhifirdaus		
		</div>
		
	</body>
<html>
<?php ob_flush(); ?>