<!doctype html>
<html>
	<head>
		<title>OJ bikewash</title>
		<link rel="icon" type="image/png" href="images/favicon.png"/>
		<link rel="stylesheet" href="login.css" type="text/css"/>
	</head>
	<body>
		<div id="wrapper">
		<div id="logo"></div>
		<div id="form">
		<form method="POST" action="session_login.php">
		<input type="text" name="username" value="username" required="yes" onfocus="if(this.value=='username') this.value='';" onblur="if(this.value=='') this.value='username';"/><br>
		<input type="text" name="password" value="password" required="yes" onfocus="if(this.value=='password') this.value=''; this.type='password';" onblur="if(this.value=='')  this.value='password';"/>
		</div>
		<div id="button">
		<input type="submit" value="Masuk"/>		
		</div>
		</form>
		</div>	
	</body>
<html>

<?php
if(isset($_GET['error'])){
			echo"
			<div id='popup' style='visibility:visible;'>
				<div class='window'>
				<h3>Login Gagal</h3>
				Silakan login dengan username dan password yang benar
				<a href='login.php' style='position:relative;left:60px;'><input type='submit' value='oke'></a>								
				</div>
			</div>
			";
}
?>