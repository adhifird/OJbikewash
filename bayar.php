<?php
include 'config.php';
include 'pengaturan.php';

				$urutan = $_POST['urutan'];
				$jumlah_uang = $_POST['jumlah_uang'];
				
				//cek jumlah uang yang diinputkan
				if($jumlah_uang < $biaya){
				header('location:pembayaran.php?message=error1');
				break;
				}				
				
				//cek waktu pencucian pelanggan dari database
				$cekwaktu = mysql_query("SELECT estimasiSelesai, selesai FROM daftar_cuci WHERE id = '$urutan'");
				$waktu = mysql_fetch_array($cekwaktu);
				
				//buat variable dateTime
				$selesai_ = new DateTime($waktu['estimasiSelesai']);
				$selesai = new DateTime($waktu['selesai']);
				
				//hitung selisih estimasi waktu selesai cuci dengan selesai cuci yg sebenarnya
				//$selisihWaktu = date_diff($selesai_, $selesai);
				
				list($hoursA, $minutesA) = explode(':', $selesai_->format("H:i"));
				$selesai_ = ($hoursA * 60) + $minutesA;
				
				list($hoursB, $minutesB) = explode(':', $selesai->format("H:i"));
				$selesai = ($hoursB * 60) + $minutesB;
				
				/*
				var_dump($selesai_);
				echo "<br>";
				
				var_dump($selesai);
				echo "<br>";
				*/
				
				
				//ubah waktu cucian kedalam format menit
				//list($hours, $minutes) = explode(':', $selisihWaktu->format("%H:%i"));
				//$selisihWaktu_ = ($hours * 60) + $minutes;
				
				$selisihWaktu = $selesai - $selesai_;
				
				
				//bagi selisih waktu untuk dikalikan diskon
				//$diskon = substr(($selisihWaktu_ / $overtime2),0, -2) * $overtime;  
				
				if($selisihWaktu >= $overtime2){
					$diskon = ($selisihWaktu / $overtime2) * $overtime;
				} else {
					$diskon = 0;
				}					
						
						//cek apakah pelanggan mendapat overtime?
						if( $selisihWaktu >= $overtime2 ) {
						
							//jalankan perintah SQL
							
							$kembalian = ($jumlah_uang - ($biaya - $diskon));	
							$sqlbayar = "UPDATE daftar_cuci SET status = 'OK', bayar = '$jumlah_uang', kembalian = '$kembalian', diskon = '$diskon' WHERE id = '$urutan'";
											mysql_query ($sqlbayar) or die ("Gagal Mengeksekusi Perintah SQL". mysql_error());
												  
											//	if ($sqlbayar) {
											//	header('location:pembayaran.php');
											//	};							
							
						} else {
							$kembalian = ($jumlah_uang - $biaya);	
							$sqlbayar = "UPDATE daftar_cuci SET status = 'OK', bayar = '$jumlah_uang', kembalian = '$kembalian' WHERE id = '$urutan'";
											mysql_query ($sqlbayar) or die ("Gagal Mengeksekusi Perintah SQL". mysql_error());
												  
											//	if ($sqlbayar) {
											//	header('location:pembayaran.php');
											//	};
												
						};
								
?>

<html>
	<body>
		<form target="_blank" action='print.php'  method='POST' name='formSubmit' onSubmit="reDirect">
		<input type='hidden' name="data" value="<?php echo $urutan;?>">
		</form>
		<script type="text/javascript">
		
			function submit(){
			document.formSubmit.submit();
			}
			
			setTimeout(function reDirect(){
			window.location.href = 'pembayaran.php'; return;},
			 1000);
			
			//window.onload = function(){ window.location.href = 'index.php'; return false;};
			submit();			
		</script>
	</body>
</html>


















