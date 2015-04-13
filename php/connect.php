<?php
	$host = "localhost"; 
	$user = "root"; 
	$pass = ""; 
	$db = "zapperdb";

	//connessione:
	$connect = mysql_connect($host,$user,$pass) or die(mysql_error());

	//selezione db:
	mysql_select_db($db,$connect) or die(mysql_error());
?>
