<!doctype html>
<?php include('pengaturan.php'); 

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
		<link rel="stylesheet" href="pengaturan-biaya.css" type="text/css"/>
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
				<div class="notifikasi1">
				<h1>Pengaturan Biaya</h1>
				<p>Halaman ini mengatur ketentuan biaya cuci dan promo<br></p>
				</div>
				
		<form method="POST">	
				<!-- biaya cuci -->
				
				<div class="notifikasi2">
				<h3>Biaya Cuci</h3>
				<p>Biaya cuci motor</p>
				</div>
				<div class="opsi">
				<input style="height:25px; width:80px;" type="text" name="_biayacuci" required="yes" value="<?php echo $biaya;?>">				
				</div>
				<div style="clear:both;"></div>
				
				<!-- waktu cuci -->
				
				<div class="notifikasi2">
				<h3>Waktu Cuci</h3>
				<p>Ketentuan lama waktu cuci motor</p>
				</div>
				<div class="opsi">
				<input style="height:25px; width:80px; margin-right:10px;" type="text" name="_waktucuci" required="yes" value="<?php echo $waktucuci;?>">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <b>Menit</b>
				</div>
				<div style="clear:both;"></div>
				
				<!-- overtime -->
				
				<div class="notifikasi2">
				<h3>Diskon Overtime</h3>
				<p>Diskon yang diberikan setiap terjadi overtime</p>
				</div>
				<div class="opsi">
					<select name="_overtime">
					<option selected="selected" value="<?php echo $overtime;?>">Rp.<?php echo $overtime;?></option>
					<option value="0">-</option> 
					<option value="500">Rp.500,-</option> 
					<option value="1000">Rp.1000,-</option>
					<option value="1500">Rp.1500,-</option>
					<option value="2000">Rp.2000,-</option>
					</select>
					&nbsp &nbsp &nbsp &nbsp &nbsp <b>Setiap</b>:
					<select name="_overtime2">
					<option selected="selected" value="<?php echo $overtime2;?>"><?php echo $overtime2;?></option>
					<option value="0">-</option> 
					<option value="5">5</option> 
					<option value="10">10</option>
					<option value="15">15</option>
					</select> <b>Menit</b>
				</div>
				<div style="clear:both;"></div>
				<div class="notifikasi2">
				
				<!-- cuci gratis -->
				
				<h3>Cuci Gratis</h3>
				<p>Cuci gratis setiap setelah sekian kali pencucian</p>
				</div>
				<div class="opsi">
					<select name="_gratis">
					<option selected="selected" value="<?php echo $gratis;?>"><?php echo $gratis;?></option>
					<option value="0">-</option> 
					<option value="5">5</option>
					<option value="7">7</option>
					<option value="10">10</option>
					</select>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <b>X cuci</b>
				</div>
				
				<!-- hadiah -->				
				
				<div style="clear:both;"></div>
				<div class="notifikasi2">
				<h3>Hadiah</h3>
				<p>Hadiah setiap setelah sekian kali pencucian</p>
				</div>
				<div class="opsi">
					<select name="_hadiah">
					<option selected="selected" value="<?php echo $hadiah;?>"><?php echo $hadiah;?>x Cuci</option>
					<option value="0">-</option> 
					<option value="5">5 x Cuci</option> 
					<option value="10">10 x Cuci</option>
					<option value="15">15 x Cuci</option>
					<option value="20">20 x Cuci</option>
					</select>
					<b>Jenis Hadiah:</b>
					<select name="_hadiah2">
					<option selected="selected" value="<?php echo $hadiah2;?>"><?php echo $hadiah2;?></option>
					<option value="">-</option> 
					<option value="diskon">diskon</option> 
					<option value="souvenir">souvenir</option>
					<option value="cuci gratis">cuci gratis</option>
					<option value="softdrink">softdrink</option>
					</select><br>
					<input type="submit" name="_simpan" value="Simpan">	
				</div>
				<div style="margin-bottom:50px;clear:both;"> </div>
		</div>
				
				
		</form>		
		
		<?php
				
				if(isset($_POST['_simpan'])){
					$_biayacuci = $_POST['_biayacuci'];
					$_waktucuci = $_POST['_waktucuci'];
					$_overtime = $_POST['_overtime'];
					$_overtime2 = $_POST['_overtime2'];
					$_gratis = $_POST['_gratis'];
					$_hadiah = $_POST['_hadiah'];
					$_hadiah2 = $_POST['_hadiah2'];
					
							echo "<div id='popup' style='visibility:visible;'>
														<div class='window'>
														<h3>Data berhasil disimpan</h3>
														<a href='pengaturan-biaya.php'><input type='submit' value='OK'></a>
														</div>
													</div>";
							
									$myfile = fopen("pengaturan.php", "w") or die("Unable to open file!");
									$txt = '<?php
									
									
											$biaya = '.$_biayacuci.';
											$waktucuci = '.$_waktucuci.';
											$overtime = '.$_overtime.';
											$overtime2 = '.$_overtime2.';
											$gratis = '.$_gratis.';
											$hadiah = '.$_hadiah.';
											$hadiah2 = "'.$_hadiah2.'";
											
											
												//melipatkan nilai & menyimpannya kedalam array// 
												
												$a = 0;
												$b = 0;
												$c = 0;
												
												$_overtime2 = array();
												$_gratis = array();
												$_hadiah = array();
												
												if($overtime2 != 0 ){
													do{
													  $a = $a+$overtime2;
													  $_overtime2[] = $a;
													}while ($a <= 100);
												}else{
													do{
													$a = ++$a;
													$_overtime2[] = $a;
													}while ($a <= 1);													
												}

												if($gratis != 0 ){
													do{
													  $b = $b+$gratis;
													  $_gratis[] = $b;
													}while ($b <= 100);
												}else{
													do{
													$b = ++$b;
													$_gratis[] = $b;
													}while ($b <= 1);													
												}
												   
												if($hadiah != 0 ){
													do{
													  $c = $c+$hadiah;
													  $_hadiah[] = $c;
													}while ($c <= 100);
												}else{
													do{
													$c = ++$c;
													$_hadiah[] = $c;
													}while ($c <= 1);													
												}
											
											?>';
											
									fwrite($myfile, $txt);
									fclose($myfile);
									
									
									
				}?>
		
		
		
				
		
		<div id="footer">
		OJbikewash - developed by: Adhifirdaus		
		</div>
		
	</body>
<html>