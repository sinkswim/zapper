<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="it">

<head>
	<title> Tentativo di login a Zapper! </title>
<?php
	include 'header.php';
	include ("connect.php");

	$sql = "SELECT * FROM users WHERE username='".$_POST["username"]."' and password='".$_POST["password"]."'";
	$result = $mysqli_connection->query($sql);
	
	if ($result->num_rows == 1) {
	  while($row = $result->fetch_assoc()) {
		session_start();
		$_SESSION["username"]=$_POST["username"]; //variabile di sessione
		header('Location: game.php'); 						//reindirizzamento al pagina di gioco
	  }
	} else {
		echo ('<div>Incorrect username or password, <a href="../index.php">try again</a>!</div>');
	}
	
	// $mysqli_connection->close();
?> 
		
</body>
</html>

