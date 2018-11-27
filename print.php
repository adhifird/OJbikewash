<?php
					include 'config.php';
					
					if(empty($_POST['data'])){
					echo "direct access to this page is forbidden!";
					header('location:pembayaran.php');
					}else{
					$print = "document.onload.print();";
					}
					
					
					$id = $_POST['data'];
					
					$daftar_cuci =  mysql_query
												("SELECT pelanggan.id, pelanggan.nama, tnkb, tipe_kendaraan, masuk, lamaAntri, lamaCuci, selesai, diskon, bayar, kembalian
												FROM daftar_cuci
												JOIN pelanggan ON daftar_cuci.id_pelanggan = pelanggan.id
												WHERE daftar_cuci.id = $id
												");
					$tabel = mysql_fetch_array($daftar_cuci);
					//$masuk = substr(($tabel['masuk']),5, -3);
					$masuk = new dateTime($tabel['masuk']);
					//$masuk = $masuk->format("j M G:i");
					
					//$lamaAntri = (new dateTime($tabel['lamaAntri']))->format("h:i");
					//$lamaCuci = (new dateTime($tabel['lamaCuci']))->format("h:i");
					//$selesai = (new dateTime($tabel['selesai']))->format("h:i");
					//echo $tabel['lamaAntri'];
					$lamaAntri = substr(($tabel['lamaAntri']),0, -3);
					$lamaCuci = substr(($tabel['lamaCuci']),0, -3);
					$selesai = substr(($tabel['selesai']),11, -3);
					
					
					
?>
<html>
	<head>
	
	<style type="text/css">
	*{margin:0;padding:0;font-family:calibri, ‚segoe ui‛, arial, tahoma, sans-serif;}
	#tr_header td {padding:3px 0 0 10px;border-bottom:1px solid black;}
	#tabel {margin-bottom:100px;}
	#tr_data td {padding:3px 0 0 10px; font-weight:bold;}	
	</style>
	</head>
	<body>
		<div id="container" style="width:720px;overflow:hidden;">
			<div id="header" style="float:left;margin-bottom:30px;">
				<img id="logo" src="images/ojbikewash.png">
			</div>
			<div id="header-kanan" align=right style="float:right;margin:20px 20px 10px 0;font-size:10pt;">
				<h4>OJ Bikewash</h4>
				Tempat nyuci motor paling asik<br>
				Jl.Simpang Dewandaru No.6<br>
				0822 5858 0220<br>
				Malang 
			</div>
				<div id="tabel">
					<table cellpadding=0 cellspacing=0 width=720>
					<tr id="tr_header">
						<td width=20 style="border-right:1px solid black; border-left:1px solid black;">ID</td>
						<td width=150>Nama</td>
						<td>TNKB</td>
						<td>Tipe Kendaraan</td>
						<td>Masuk</td>
						<td>Waktu Antri</td>						
						<td>Lama Cuci</td>
						<td>Selesai</td>
					</tr>
					<tr id="tr_data" height=50>
						<td style="border-right:1px solid black;padding-left:10px;border-left:1px solid black;"><?php echo $tabel['id'];?></td>
						<td><?php echo $tabel['nama'];?></td>
						<td><?php echo $tabel['tnkb'];?></td>
						<td><?php echo $tabel['tipe_kendaraan'];?></td>
						<td align=center><?php echo $masuk->format("j M")."<br>".$masuk->format("G:i");?></td>
						<td align=center><?php echo $lamaAntri;?><br></td>
						<td align=center><?php echo $lamaCuci;?><br></td>						
						<td><?php echo $selesai;?></td>
					</tr>
					</table>
				</div>
				<div class="line" style="width:720;border-bottom:1px solid black;"></div>
				<div id="left-footer" style="float:left;margin-top:20px;padding-left:20px;font-size:9pt">
				<h4>Terimakasih atas kunjungan Anda</h4>
				<br>Dapatkan:<br>
				-diskon bila pelayanan kami overtime<br>
				-cuci gratis setiap kelipatan 10x cuci<br>
				-hadiah setiap kelipatan 15x cuci
				</div>
				<div id="data-tagihan" style="float:right;margin-top:20px;padding-right:20px;font-size:11pt;font-weight:bold;">
				<div class="bayar" style="color:red;">:Rp.<?php echo $tabel['bayar'];?>,-</div>
				:Rp.6000,-<br>				
				:Rp.<?php echo $tabel['diskon'];?>,-<br>
				<div class="bayar" style="color:red;">:Rp.<?php echo $tabel['kembalian'];?>,-</div>
				</div>
				<div id="tagihan" style="float:right;margin-top:20px;padding-right:20px;font-size:11pt;">
				Bayar<br>
				Biaya Cuci <br>				
				Diskon<br>
				Kembalian<br>
				</div>
		</div>
		
		<script type="text/javascript">
		setTimeout(function print(){
		window.print();
		},1000);
		//document.onload.print();
		<?php echo $print; ?>
		</script>
</body>
</html>