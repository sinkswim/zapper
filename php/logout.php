<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="it">

<head>
	<title> Logout! </title>
<?php
	include 'header.php';
	session_start();	/*TODO is this necessary? */
	session_destroy();
?> 
		
	<div class="logout">
	<h3>Ti sei disconnesso con successo!</h3>
 	<p> <a href="../index.php">Torna alla pagina principale.</a> </p>
	</div>
	
</body>
</html>
