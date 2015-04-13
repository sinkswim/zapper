<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="it">

<head>
	<title> Punteggi Zapper </title>	
<?php
	include("connect.php");
	session_start();
	if(!isset($_SESSION['username'])) 
        header('Location: ../index.php');
	include 'header.php';


	$query = "SELECT record FROM users WHERE username='$_SESSION[username]'";
	$result = mysql_query($query);
	$ret = mysql_fetch_array($result);
	echo "<h1>Il tuo record e': $ret[0] </h1>";
	$query = "SELECT username,record FROM users ORDER BY record DESC LIMIT 5";
	$result = mysql_query($query);
	echo "<h2>La TOP 5 e': </h2><p>";
	while($ret = mysql_fetch_assoc($result)){
						 echo "<div>".$ret['username']." ";
						 echo $ret['record']."</div>";
						 }
	echo "</p>";
?>

	<div>
		<input type="button" value=" Log Out " onClick="window.location='logout.php'">
	</div>
	
</body>
</html>



