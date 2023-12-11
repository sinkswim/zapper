<?php
	$host = "localhost"; 
	$user = "root"; 
	$pass = ""; 
	$db = "zapperdb";
		echo ('<div>Connect line 6</div>');
	//connessione:
	$connect = mysql_connect($host,$user,$pass) or die(mysql_error());
		echo ('<div>Connect line 9</div>');
	//selezione db:
	mysql_select_db($db,$connect) or die(mysql_error());
		echo ('<div>Connect line 12</div>');
?>
