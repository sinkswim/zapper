<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="it">

<head>
	<title> Registrati a Zapper! </title>
<?php
	include 'header.php';
?>

		
	<form action="../php/register.php" method="post">
		<div>
			<h2>Sign up now:</h2>
			<div><p>Username:
			<input type="text" name="username" >
			Password:
			<input type="password" name="password" >
			Repeat Password:
			<input type="password" name="repassword" ></p></div>
			<input type="submit" value="Sign up" >
			
			
			<p> Username and password must be at least 5 and not over 12 characters in length. Only letters and numbers are permitted. </p>
		</div>
	</form>

</body>
</html>