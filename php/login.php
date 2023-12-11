<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="it">

<head>
	<title> Tentativo di login a Zapper! </title>
<?php
	include 'header.php';
	include ("connect.php");
	echo ('<div>login line 9</div>');
	if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE username='".$_POST["username"]."' and password='".$_POST["password"]."'"))==1){
		session_register("username"); //chiamata implicita senza parametri a session_start()
		$_SESSION['username']=$_POST["username"]; //variabile di sessione
		header('Location: game.php'); 						//reindirizzamento al pagina di gioco
		}
	else 
  		echo ('<div>Username o password errati, <a href="../index.php">riprova</a>!</div>');
?> 
		
</body>
</html>