<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="it">

<head>
	<title> Registrati a Zapper! </title>
<?php
	include 'header.php';
?>

		
	<form action="../php/register.php" method="post">
		<div>
			<h2>Registrati:</h2>
			<div><p>User Name:
			<input type="text" name="username" >
			Password:
			<input type="password" name="password" >
			Ripeti Password:
			<input type="password" name="repassword" ></p></div>
			<input type="submit" value="Registrati!" >
			
			
			<p> Username e password devono avere dimensione minima e massima di 5 e 12 caratteri 
				ed essere espressi utilizzando solamente lettere e numeri.
			</p>
		</div>
	</form>

</body>
</html>