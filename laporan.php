<!doctype html>
<?php include 'config.php.';

session_start();

function login(){ //ini untuk menampilkan popup login dulu
	echo"
			<div id='popup' style='visibility:visible;'>
				<div class='window'>
				<h3>Anda harus login dulu sebagai admin</h3>				
				<a href='index.php' ><input type='submit' style='margin-left:0px;' value='oke'></a>								
				</div>
			</div>
			";
	};

if(isset($_SESSION['session_user'])){
		
	if($_SESSION['session_user'] == "admin"){
	
	}else{
	login();
	}
	
}else{
login();
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>OJ bikewash</title>
		<link rel="icon" type="image/png" href="images/favicon.png"/>
		<link rel="stylesheet" href="laporan.css" type="text/css"/>	
		
		<link rel="stylesheet" href="datepicker/jquery-ui.css">
		<link rel="stylesheet" href="datepicker/style.css">
		<script src="datepicker/jquery-1.12.4.js"></script>
		<script src="datepicker/jquery-ui.js"></script>
		<script>
		  $( function() {
			$( "#datepicker" ).datepicker({
			yearRange: "2016:2018",
			dateFormat: "yy-mm-dd",
			changeYear: true,
			changeMonth: true
			});
		  } );
		</script>
		
	</head>
	<body>
			<div id="menu">			
				<a href="laporan.php"><li>Laporan</li></a>
				<a href="pengaturan-biaya.php"><li>Pengaturan Biaya</li></a>
				<a href="dataKasir.php"><li>Data Kasir</li></a>
				<a href="logout.php" id="logout" ><li>Logout</li></a>
			
			</div>
		<div id="halaman">
				<div id="logo">
				</div>
				<div class="notifikasi">
				<p>Tentukan parameter ini untuk menampilkan<br> data berdasarkan waktu</p>
				</div>
		<form method="POST">
				<div class="opsi">
					<input type="text" id="datepicker" name="tanggal" style="width:140px;">
				</div>
				<div class="notifikasi">
				<p>Tentukan parameter ini untuk mengurutkan<br> data berdasarkan parameter yang tersedia</p>
				</div>
				<div class="opsi">
					<select name="urutan">
					<option value="id">ID</option>
					<option value="masuk">Jam Masuk</option> 
					<option value="lama_cuci DESC">Lama Cuci</option> 
					<option value="diskon">Diskon</option>
					</select> 
				</div>
				<div id="button1">
					<input type="submit" name="urutkan" value="Urutkan data">
				</div>
		</form>
			<div id="daftar-cuci">
					
					<table cellpadding=0 cellspacing=0 width=820>
				
					<tr style="font-weight:bold;background-color:#002D59;color:white;">
					<td width=20 style="border-right:1px solid black;">No</td>
					<td width=20 style="padding-left:15px;">ID</td>
					<td width=80>Nama</td>
					<td align=center width=80>Nomor Kendaraan</td>
					<td align=center width=120>Tipe<br>Kendaraan</td>
					<td style="padding-left:15px;">Tanggal</td>
					<td style="padding-left:5px;">Masuk</td>
					<td style="padding-left:7px;">Lama Cuci</td>					
					<td>Hadiah</td>
					<td align=center>Jenis<br>Hadiah</td>
					<td width=50>Diskon</td>
					</tr>
					
					<?php
					
					
					if(isset($_POST['urutkan'])){
					
						
						if(!empty($_POST['tanggal'])){
							
						
						$tanggal = $_POST['tanggal'];
						$urutan = $_POST['urutan'];
						
						$tanggal2= substr_replace($tanggal, " 23:59:59",10);
						
						//echo $tanggal2;
						//echo $urutan;
					
								$daftar_cuci =  mysql_query
												("SELECT pelanggan.id, pelanggan.nama, tnkb, tipe_kendaraan, masuk, hadiah, jenis_hadiah, diskon , TIMEDIFF( selesai, masuk ) AS lama_cuci
												FROM daftar_cuci
												JOIN pelanggan ON daftar_cuci.id_pelanggan = pelanggan.id
												WHERE daftar_cuci.masuk BETWEEN '$tanggal' AND '$tanggal2'
												ORDER BY $urutan ");
					
						
							
									$no = 1;
									while ($tabel = mysql_fetch_array($daftar_cuci) ){	
									
									$jam_masuk = substr(($tabel['masuk']),10, -3);
									$tanggal = substr(($tabel['masuk']),0, -9);
									$lama_cuci = substr(($tabel['lama_cuci']),3);
									?>									
																		
							
									<tr class="daftar" style="background-color:<?php echo $warna; ?>;">
									
									<td style="border-right:1px solid black;background-color:#002D59;color:white;font-weight:bold;"><?php echo $no; ?></td>
									<td style="padding-left:15px;"><?php echo $tabel['id'];?></td>
									<td><?php echo $tabel['nama'];?></td>
									<td><?php echo $tabel['tnkb'];?></td>
									<td ><?php echo $tabel['tipe_kendaraan'];?></td>
									<td><?php echo $tanggal;?></td>
									<td style="padding-left:10px;"><?php echo $jam_masuk;?></td>
									<td style="padding-left:15px"><?php echo $lama_cuci;?></td>
									<td><?php echo $tabel['hadiah'];?></td>
									<td><?php echo $tabel['jenis_hadiah'];?></td>									
									<td align=right><?php echo $tabel['diskon'];?></td>
									
								<?php
								$no++;
							};
							
						}else {
						
						echo"<div id='popup' >
								<div class='window'>
								<h3>Tanggal belum ditentukan</h3>
								<a href='laporan.php' class='button'>oke</a>
								</div>
							</div>
							";
						}	
					}		
							?>
							
						</tr>
					
					</table>
						
			</div>
			
		
		</div>
		<div id="footer">
		OJbikewash - developed by: Adhifirdaus		
		</div>
		
	</body>
<html>