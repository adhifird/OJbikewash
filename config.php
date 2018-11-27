<?php
$host='localhost';
$user='root';
$pass='';
$dbname='ojbikewash';
$connect=mysql_connect($host, $user, $pass) or die(mysql_error());
$dbselecct=mysql_select_db($dbname);
?>