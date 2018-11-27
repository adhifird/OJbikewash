<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="jquery-ui.css">
  <link rel="stylesheet" href="style.css">
  <script src="jquery-1.12.4.js"></script>
  <script src="jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
	yearRange: "2005:2006",
	changeYear: true,
	changeMonth: true
	});
  } );
  </script>
</head>
<body>
<form method="POST">
<p>Date: <input type="text" id="datepicker" name="tanggal"></p>
<input type="submit" name="submit"/>
</form> 
 
 <?php 
 
	if(isset($_POST['submit'])){
		
		$tanggal = $_POST['tanggal'];
		
		print_r($tanggal);
		}
		
 
 ?>
</body>



