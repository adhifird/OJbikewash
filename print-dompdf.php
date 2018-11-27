<?php 
ob_start(); 
?>
<html>
	<style type="text/css">
	*{margin:0;padding:0;font-family:calibri, ‚segoe ui‛, arial, tahoma, sans-serif;}
	#tr_header td {padding:3px 0 0 10px;border-bottom:1px solid black;}
	#tabel {margin-bottom:100px;}
	#tr_data td {padding:3px 0 0 10px;}	
	</style>
	<body>
		<div id="container" style="width:680px;overflow:hidden;">
			<div id="header" style="float:left;margin-bottom:30px;">
				<img id="logo" src="images/ojbikewash.png">
			</div>
			<div id="header-kanan" align=right style="float:right;margin:20px 20px 10px 0;font-size:10pt;">
				<h4>OJ Bikewash</h4>
				Tempat nyuci motor paling asik<br>
				Jl.Simpang Dewandaru No.6<br>
				Malang <br>
				0822 5858 0220
			</div>
				<div id="tabel">
					<table cellpadding=0 cellspacing=0 width=680>
					<tr id="tr_header">
						<td width=20 style="border-right:1px solid black; border-left:1px solid black;">ID</td>
						<td width=150>Nama</td>
						<td>TNKB</td>
						<td>Tipe Kendaraan</td>
						<td>Masuk</td>
						<td>Lama Cuci</td>
						<td>Diskon</td>
					</tr>
					<tr id="tr_data" height=50>
						<td style="border-right:1px solid black;padding-left:10px;border-left:1px solid black;">07</td>
						<td>Mas Adhi</td>
						<td>S 9080 HI</td>
						<td>Kereta Api</td>
						<td>08:34</td>
						<td>20 menit</td>
						<td>1000</td>
					</tr>
					</table>
				</div>
				<div class="line" style="width:680px;border-bottom:1px solid black;"></div>
				<div id="left-footer" style="float:left;margin-top:20px;padding-left:20px;font-size:9pt">
				<h4>Terimakasih atas kunjungan Anda</h4>
				<br>Dapatkan:<br>
				-diskon bila pelayanan kami overtime<br>
				-cuci gratis setiap kelipatan 10x cuci<br>
				-hadiah setiap kelipatan 15x cuci
				</div>
				<div id="data-tagihan" style="float:right;margin-top:20px;padding-right:20px;font-size:11pt;font-weight:bold;">
				:Rp.6000,-<br>
				:Rp.10000,-<br>
				:Rp.1000,-<br>
				:Rp.5000,-<br>
				</div>
				<div id="tagihan" style="float:right;margin-top:20px;padding-right:20px;font-size:11pt;">
				Biaya Cuci <br>
				Bayar<br>
				Diskon<br>
				Kembalian<br>
				</div>
		</div>
</body>
</html>
<?php 
require_once("dompdf/dompdf_config.inc.php"); 
$dompdf = new DOMPDF(); 
$dompdf->load_html(ob_get_clean()); 
$dompdf->render(); 
$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

exit(0);
?>