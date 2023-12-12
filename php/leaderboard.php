<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="it">

<head>
	<title> Punteggi Zapper </title>	
<?php
	include("connect.php");
	session_start();
	if(!isset($_SESSION['username'])) 
        header("Location: ../index.php");
	include "header.php";


	$query = "SELECT record FROM users WHERE username='$_SESSION[username]'";
	$result = $mysqli_connection->query($query);
	$row = $result -> fetch_array(MYSQLI_NUM);
	$query = "SELECT username,record FROM users ORDER BY record DESC LIMIT 5";
	$result = $mysqli_connection->query($query);
	echo "<h2>The top 5 leaderboard is: </h2><p>";
	while($ret = mysqli_fetch_assoc($result)){
		echo "<div>".$ret['username']." ";
		echo $ret['record']."</div>";
	}
	echo "</p>";
	echo "<h2>Your personal record is: $row[0] </h2>";

?>

	<div>
		<input type="button" value=" Log Out " onClick="window.location='logout.php'">
	</div>
	
</body>
</html>



