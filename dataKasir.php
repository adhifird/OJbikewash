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
		<title>OJ bikewash</title>
		<link rel="icon" type="image/png" href="images/favicon.png"/>
		<link rel="stylesheet" href="datakasir.css" type="text/css"/>
	<head>
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
				<div id="notifikasi">
				<h1>Data Kasir</h1>
				<p>Untuk menambah kasir masukan nama dan passwordnya</p>
				</div>
			
				
				<form method="POST">
					<div class="form">
					<label for="nama">Nama :</label>
					<input type="text" name="nama" required="yes"/>
					</div>
					<div class="form">
					<label for="password">Password :</label>
					<input type="text" name="password" required="yes"/>
					</div>
					<div id="tombol-simpan">
					<input type="submit" name="daftarkan" value="Daftarkan" />
					</div>
				</form>
					
					<table cellpadding=0 cellspacing=0 width=520
					style="margin:0 auto 35px auto;
					">
				
					<tr class="tbhead">
					<td width=25 style="border-right:1px solid black;">ID</td>
					<td width=80 style="padding-left:15px;">Nama</td>
					<td width=100>Password</td>
					<td width=100>Last Login</td>
					<td width=100>Last Logout</td>
					<td>Edit</td>
					<td>Hapus</td>
					</tr>
					
					
					<?php
					$data = mysql_query("SELECT id, nama, 
										password , DATE_FORMAT( lastlogin,  '%e %b %H:%i' ) AS login, DATE_FORMAT( lastlogout, '%e %b %H:%i' ) AS logout
										FROM datakasir");
										
					while ( $dataKasir = mysql_fetch_array($data)){
					
					
					echo "<tr class='list'>";
					echo "<td style='border-right:1px solid black;'>".$dataKasir['id']."</td>";
					echo "<td style='padding-left:15px;'>".$dataKasir['nama']."</td>";
					echo "<td><input style='border:none; width:100px;' disabled='yes' type='password' value='".$dataKasir['password']."'/></td>";
					echo "<td>".$dataKasir['login']."</td>";
					echo "<td>".$dataKasir['logout']."</td>";
					
					echo "<form method='post' action=''>
						 <input type='hidden' name='idKasir' value='".$dataKasir['id']."'/>
						 <input type='hidden' name='namaKasir' value='".$dataKasir['nama']."'/>
						 <input type='hidden' name='passwordKasir' value='".$dataKasir['password']."'/>
						 <td class='edit'><input  type='submit' name='edit' value=' ' /></td>
						 <td class='hapus'><input  type='submit' name='hapus' value=' ' /></td>
						 </form>";
					}
					?>
					
					</table>
		
		
			<?php
				
				if(isset($_POST['daftarkan'])){
					$nama = $_POST['nama'];
					$password = $_POST['password'];
					
							function sudahAda(){
							echo "<div id='popup' style='visibility:visible;'>
														<div class='window'>
														<h3>Nama sudah ada. Masukkan nama lain.</h3>
														<a href='dataKasir.php'><input type='submit' value='Oke'></a>	
														</div>
													</div>";						
							
							}
					
							$sqlcuci = "INSERT INTO datakasir SET nama = '$nama', password = '$password'";
							$cekquery = mysql_query ($sqlcuci) or die (sudahAda());
						
							if($cekquery){
							echo "<div id='popup' style='visibility:visible;'>
														<div class='window'>
														<h3>Data berhasil disimpan</h3>
														<a href='dataKasir.php'><input type='submit' value='Oke'></a>	
														</div>
													</div>";							 
							}					
				}
				
				if(isset($_POST['edit'])){
				
				$idKasir = $_POST['idKasir'];
				$namaKasir = $_POST['namaKasir'];
				$passwordKasir = $_POST['passwordKasir'];
				
													echo "<div id='popup' >
														<div class='window'>
														<h3>Edit User $namaKasir</h3>
														
														<form method='POST' action=''>
														
														<div style='font-weight:bold;float:left;text-align:right;margin:20px 10px 0 50px;'>
														Nama<br><br>
														Password
														</div>
														
														<div style='font-weight:bold;float:left; margin:20px 10px 0 0;'>														
														<input type='hidden' name='id' value='$idKasir'>
														<input type='text' required='yes' name='nama' value='$namaKasir'>
														<br><br>														
														<input type='text' required='yes' name='password' value='$passwordKasir'>
														<br>
														</div>
														<div style='clear:both'></div>
														<input type='submit' name='edituser' value='Simpan'/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp													
														<a href='dataKasir.php'><input type='submit' value='Nggak jadi'></a>
														</form>														
														</div>
													</div>";
													
				}else if(isset($_POST['edituser'])){	
								$idKasir = $_POST['id']; 
								$namaKasirNew = $_POST['nama'];
								$passwordKasirNew = $_POST['password'];
								
								mysql_query ("UPDATE datakasir SET nama = '$namaKasirNew', password = '$passwordKasirNew' WHERE id = '$idKasir'")
													or die ("<div id='popup' style='visibility:visible;'>
															<div class='window'>
															<h3>Nama sudah ada. Masukkan nama lain.</h3>
															<a href='dataKasir.php'><input type='submit' value='Oke'></a>	
															</div>
															</div>");
								//if (mysql_query){
								echo "<script>window.location.reload()</script>";
								//header('location:datakasir.php');
								//}
													
				
				}else if(isset($_POST['hapus'])){
				$idKasir = $_POST['idKasir'];
				$namaKasir = $_POST['namaKasir'];
				
													echo "<div id='popup' >
														<div class='window'>
														<h3>Apakah user $namaKasir akan dihapus?</h3>
														<form method='POST' action=''>
														<input type='hidden' name='idKasir_' value='$idKasir'/>
														<input type='submit' name='hapus_' value='Iya, hapus'/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
														<a href='dataKasir.php'><input type='submit' value='Nggak jadi'></a>
														</form>														
														</div>
													</div>";
													
				}

				if(isset($_POST['hapus_'])){
				$idKasir_ = $_POST['idKasir_'];
				
				mysql_query ("DELETE FROM datakasir WHERE id = $idKasir_");
				mysql_query ("ALTER TABLE datakasir  AUTO_INCREMENT = 0");
				
				if (mysql_query){
								
								header('location:datakasir.php');
								}
				
				
				}
				
			?>
			
				
		
		</div>
		<div id="footer">
		OJbikewash - developed by: Adhifirdaus		
		</div>
		
	</body>
<html>